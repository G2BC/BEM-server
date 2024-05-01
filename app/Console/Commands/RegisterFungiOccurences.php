<?php

namespace App\Console\Commands;

use App\Models\Fungi;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Utils\CustomSheetReader;
use App\Utils\Enums\BemClassification;
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
        $this->info('Iniciando leitura da planilha...');
        $filePath = (dirname(__FILE__, 4) . '\support\Brazilian_Edible_Mushrooms_Final.xlsx');

        $reader = new Xlsx();

        $sheetsInfo = $reader->listWorksheetInfo($filePath);
        $readerFilter = new CustomSheetReader(2, $sheetsInfo[0]['totalRows'], range('A', $sheetsInfo[0]['lastColumnLetter']));

        $bar = $this->output->createProgressBar($sheetsInfo[0]['totalRows']);
        $bar->start();

        $reader->setReadFilter($readerFilter);
        $reader->setReadDataOnly(true);
        $reader->setLoadSheetsOnly(['BEM', 'Literature_Ocurrence']);

        $spreadsheet = $reader->load($filePath);
        $fungis = $spreadsheet->getSheetByName('BEM');
        $occurrences = $spreadsheet->getSheetByName('Literature_Ocurrence');
        
        for ($row = 2; $row <= $sheetsInfo[0]['totalRows']; $row++) {
            try {
                DB::beginTransaction();
                $fungiModel = new Fungi(
                    [
                        'uuid' => Str::uuid(),
                        'kingdom' => $fungis->getCell("B{$row}")->getValue(),
                        'phylum' => $fungis->getCell("C{$row}")->getValue(),
                        'class' => $fungis->getCell("D{$row}")->getValue(),
                        'order' => $fungis->getCell("E{$row}")->getValue(),
                        'family' => $fungis->getCell("F{$row}")->getValue(),
                        'genus' => $fungis->getCell("G{$row}")->getValue(),
                        'specie' => $fungis->getCell("H{$row}")->getValue(),
                        'scientific_name' => ($fungis->getCell("G{$row}")->getValue() . ' ' . $fungis->getCell("H{$row}")->getValue()),
                        'inaturalist_taxa' => $fungis->getCell("L{$row}")->getValue(),
                        'popular_name' => $fungis->getCell("M{$row}")->getValue(),
                        'bem' => BemClassification::getValueByBame($fungis->getCell("N{$row}")->getValue()),
                        'threatened' => null,
                        'description' => null
                    ]
                );
                $fungiModel->save();
                DB::commit();

                $bar->advance();
            } catch (\Throwable $th) {
                DB::rollBack();
                $this->error($th->getMessage());
            }
            break;
        }
        $bar->finish();
    }
}
