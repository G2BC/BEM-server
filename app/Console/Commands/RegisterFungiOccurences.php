<?php

namespace App\Console\Commands;

use App\Models\Fungi;
use App\Models\Occurrence;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Utils\CustomSheetReader;
use App\Utils\Enums\BemClassification;
use App\Utils\Enums\OccurrenceTypes;
use App\Utils\Enums\StatesAcronyms;
use Illuminate\Support\Facades\DB;

class RegisterFungiOccurences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-fungi-occurrences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa fungos e ocorrencias para o bd com base no arquivo Brazilian_Edible_Mushrooms_Final.xlsx';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando leitura da planilha.');
        $filePath = (dirname(__FILE__, 4) . '\support\Brazilian_Edible_Mushrooms_Final.xlsx');

        $reader = new Xlsx();

        $sheetsInfo = $reader->listWorksheetInfo($filePath);
        $readerFilter = new CustomSheetReader(2, $sheetsInfo[0]['totalRows'], range('A', $sheetsInfo[0]['lastColumnLetter']));

        $reader->setReadFilter($readerFilter);
        $reader->setReadDataOnly(true);
        $reader->setLoadSheetsOnly(['BEM', 'Literature_Ocurrence']);

        $spreadsheet = $reader->load($filePath);
        $fungisSheet = $spreadsheet->getSheetByName('BEM');
        $occurrencesSheet = $spreadsheet->getSheetByName('Literature_Ocurrence');

        $this->info('Iniciando importação para o banco.');
        $bar = $this->output->createProgressBar($sheetsInfo[0]['totalRows']);
        $bar->start();

        for ($row = 2; $row <= $sheetsInfo[0]['totalRows']; $row++) {
            $fungiLineId = $fungisSheet->getCell("A{$row}")->getValue();

            if (Fungi::where('inaturalist_taxa', $fungisSheet->getCell("L{$row}")->getValue())->doesntexist()) {
                try {
                    DB::beginTransaction();
                    $fungiModel = Fungi::updateOrCreate(
                        ['inaturalist_taxa' => $fungisSheet->getCell("L{$row}")->getValue()],
                        [
                            'uuid' => Str::uuid(),
                            'kingdom' => $fungisSheet->getCell("B{$row}")->getValue(),
                            'phylum' => $fungisSheet->getCell("C{$row}")->getValue(),
                            'class' => $fungisSheet->getCell("D{$row}")->getValue(),
                            'order' => $fungisSheet->getCell("E{$row}")->getValue(),
                            'family' => $fungisSheet->getCell("F{$row}")->getValue(),
                            'genus' => $fungisSheet->getCell("G{$row}")->getValue(),
                            'specie' => $fungisSheet->getCell("H{$row}")->getValue(),
                            'scientific_name' => ($fungisSheet->getCell("G{$row}")->getValue() . ' ' . $fungisSheet->getCell("H{$row}")->getValue()),
                            'inaturalist_taxa' => $fungisSheet->getCell("L{$row}")->getValue(),
                            'popular_name' => $fungisSheet->getCell("M{$row}")->getValue(),
                            'bem' => BemClassification::getValueByName($fungisSheet->getCell("N{$row}")->getValue()),
                            'threatened' => null,
                            'description' => null
                        ]
                    );

                    //FIX: $row não corresponde ao mesmo registro entre pastas
                    $statesAcr = explode(',', ($occurrencesSheet->getCell("B{$row}")->getValue()));

                    $occurrencesIds = collect([]);
                    foreach ($statesAcr as $acr) {
                        $occurrence = Occurrence::create(
                            [
                                'uuid' => Str::uuid(),
                                'inaturalist_taxa' => null,
                                'specieslink_id' => null,
                                'type' => is_null($fungisSheet->getCell("N{$row}")->getValue()) ? null : OccurrenceTypes::Literature->value,
                                'state_acronym' => trim($acr),
                                'state_name' => StatesAcronyms::getStateByAcronym(trim($acr)),
                                'biome' => $occurrencesSheet->getCell("C{$row}")->getValue(),
                                'literature_reference' => null,
                                'latitude' => null,
                                'longitude' => null
                            ]
                        );

                        $occurrencesIds->add($occurrence->id);
                    }

                    $fungiModel->occurrences()->syncWithoutDetaching($occurrencesIds->toArray());

                    DB::commit();
                    $bar->advance();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    $this->error("\n Registro invalido, specie_id:{$fungiLineId}");
                    $this->error($th->getMessage());
                }
            }
        }
        $bar->finish();
    }
}
