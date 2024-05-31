<?php

namespace App\Console\Commands;

use App\Models\Fungi;
use App\Models\Occurrence;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Utils\CustomSheetReader;
use App\Utils\Enums\BemClassification;
use App\Utils\Enums\RedListClassification;
use App\Utils\Enums\OccurrenceTypes;
use App\Utils\Enums\StatesAcronyms;
use GuzzleHttp\Client;
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
        $filePath = (dirname(__FILE__, 4) . '/support/Brazilian_Edible_Mushrooms_Final.xlsx');

        $reader = new Xlsx();

        $sheetsInfo = $reader->listWorksheetInfo($filePath);
        $readerFilter = new CustomSheetReader(2, $sheetsInfo[0]['totalRows'], range('A', $sheetsInfo[0]['lastColumnLetter']));

        $reader->setReadFilter($readerFilter);
        $reader->setReadDataOnly(true);
        $reader->setLoadSheetsOnly(['BEM', 'Literature_Ocurrence']);

        $spreadsheet = $reader->load($filePath);
        $fungisCollection = collect($spreadsheet->getSheetByName('BEM')->toArray());
        $occurrencesCollection = collect($spreadsheet->getSheetByName('Literature_Ocurrence')->toArray());

        $client = new Client();
        $apiKey = '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee'; //Chave de API da IUCN

        $this->info('Iniciando importação para o banco.');
        $bar = $this->output->createProgressBar($sheetsInfo[0]['totalRows']);
        $bar->start();

        $fungisCollection->splice(1)->each(function ($fungiRow) use ($occurrencesCollection, $bar, $client, $apiKey) {
            $fungiLineId = $fungiRow[0];

            if (Fungi::where('inaturalist_taxa', $fungiRow[11])->doesntexist()) {
                try {
                    $genus = Str::lower(trim($fungiRow[6]));
                    $specie = trim($fungiRow[7]);

                    $response = $client->get("https://apiv3.iucnredlist.org/api/v3/species/{$genus}%20{$specie}?token={$apiKey}");
                    $data = json_decode($response->getBody()->getContents(), true);

                    $iucnData = array_key_exists('result', $data) ? collect($data['result']) : collect();

                    DB::beginTransaction();
                    $fungiModel = Fungi::updateOrCreate(
                        ['inaturalist_taxa' => $fungiRow[11]],
                        [
                            'uuid' => Str::uuid(),
                            'kingdom' => trim($fungiRow[1]),
                            'phylum' => trim($fungiRow[2]),
                            'class' => trim($fungiRow[3]),
                            'order' => trim($fungiRow[4]),
                            'family' => trim($fungiRow[5]),
                            'genus' => trim($fungiRow[6]),
                            'specie' => $specie,
                            'scientific_name' => (trim($fungiRow[6]) . ' ' . $specie),
                            'authors' =>  trim($fungiRow[8]),
                            'brazilian_type' => $fungiRow[9],
                            'brazilian_type_synonym' => $fungiRow[10],
                            'inaturalist_taxa' => $fungiRow[11],
                            'popular_name' => trim($fungiRow[12]),
                            'bem' => BemClassification::getValueByName(trim($fungiRow[13])),
                            'threatened' => $iucnData->isEmpty() ? RedListClassification::NE->value : RedListClassification::getValueByName($iucnData->shift()['category']),
                            'description' => null
                        ]
                    );

                    $fungiOccurrences = $occurrencesCollection->filter(function ($occurrenceRow) use ($fungiLineId) {

                        return $occurrenceRow[0] == $fungiLineId;
                    });
                    $occurrencesIds = collect([]);

                    $fungiOccurrences->each(function ($occurrence) use ($fungiRow, $occurrencesIds) {
                        $statesAcr = explode(',', ($occurrence[1]));

                        foreach ($statesAcr as $acr) {

                            if (Str::length(trim($acr)) == 2) {
                                $occurrence = Occurrence::create(
                                    [
                                        'uuid' => Str::uuid(),
                                        'inaturalist_taxa' => null,
                                        'specieslink_id' => null,
                                        'type' => is_null($fungiRow[8]) ? null : OccurrenceTypes::Literature->value,
                                        'state_acronym' => strtoupper(trim($acr)),
                                        'state_name' => StatesAcronyms::getStateByAcronym(strtoupper(trim($acr))),
                                        'habitat' => trim($occurrence[2]),
                                        'literature_reference' => null,
                                        'latitude' => null,
                                        'longitude' => null,
                                        'curation' => true
                                    ]
                                );

                                $occurrencesIds->add($occurrence->id);
                            }
                        }
                    });

                    $fungiModel->occurrences()->syncWithoutDetaching($occurrencesIds->toArray());

                    DB::commit();
                    $bar->advance();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    $this->error("\n Registro invalido, specie_id:{$fungiLineId}");
                    $this->error($th->getMessage());
                }
            }
        });
        $bar->finish();
    }
}
