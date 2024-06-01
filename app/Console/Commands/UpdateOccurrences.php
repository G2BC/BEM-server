<?php

namespace App\Console\Commands;

use App\Models\Fungi;
use App\Models\Occurrence;
use App\Utils\Enums\OccurrenceTypes;
use App\Utils\Enums\StatesAcronyms;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateOccurrences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-occurrences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza registro de ocorrencias no sistema com importações do iNaturalist e SpeciesLink';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();
        ini_set('memory_limit', '1024M');
        set_time_limit(1200);

        $lastUpdatedDate = '';
        $today = Carbon::today()->format('d-m-Y');
        try {
            DB::beginTransaction();
            $bar = $this->output->createProgressBar(Fungi::all()->count());
            $bar->start();

            Fungi::all()->each(function (Fungi $fungi) use ($client, $lastUpdatedDate, $today, $bar) {
                $occurrencesIds = collect();

                if (!is_null($fungi->inaturalist_taxa)) {
                    $iNaturalistResults = collect();

                    $iNaturalistResponse = $client->get("https://api.inaturalist.org/v1/observations?per_page=200&page=1&place_id=6878&taxon_id={$fungi->inaturalist_taxa}&created_d1={$lastUpdatedDate}&created_d2={$today}");
                    $iNaturalistData = json_decode($iNaturalistResponse->getBody()->getContents(), true);
                    $iNaturalistResults->add($iNaturalistData['results']);

                    if ($iNaturalistData['total_results'] > 200) {
                        $totalPages = round($iNaturalistData['total_results'] / $iNaturalistData['per_page']) + 1;
                        for ($i = 2; $i < $totalPages; $i++) {
                            $iNaturalistResponse = $client->get("https://api.inaturalist.org/v1/observations?per_page=200&page={$i}&place_id=6878&taxon_id={$fungi->inaturalist_taxa}&created_d1={$lastUpdatedDate}&created_d2={$today}");
                            $iNaturalistData = json_decode($iNaturalistResponse->getBody()->getContents(), true);
                            $iNaturalistResults->add($iNaturalistData['results']);
                        }
                    }
                    $iNaturalistResults->flatten(1)->each(function ($newOccurrence) use ($occurrencesIds) {
                        $state = null;
                        if (!is_null($newOccurrence['place_guess'])) {
                            $state = StatesAcronyms::searchForStateAc($newOccurrence['place_guess']) ?? StatesAcronyms::searchForState($newOccurrence['place_guess']);
                        }

                        $lat = null;
                        $lng = null;
                        if (!is_null($newOccurrence['location'])) {
                            $lat = explode(',', $newOccurrence['location'])[0];
                            $lng = explode(',', $newOccurrence['location'])[1];
                        }

                        $occurrence = Occurrence::updateOrCreate(
                            ['inaturalist_taxa' => $newOccurrence['id']],
                            [
                                'uuid' => Str::uuid(),
                                'inaturalist_taxa' => $newOccurrence['id'],
                                'specieslink_id' => null,
                                'type' => OccurrenceTypes::iNaturalist->value,
                                'state_acronym' => is_null($state) ? '' : $state->name,
                                'state_name' => is_null($state) ? '' : $state->value,
                                'habitat' => '',
                                'literature_reference' => null,
                                'latitude' => $lat,
                                'longitude' => $lng,
                                'curation' => false
                            ]
                        );

                        $occurrencesIds->add($occurrence->id);
                    });
                }

                // $speciesLinkKey = env('SPECIES_LINK_KEY');
                // $speciesLinkResponse = $client->get("");
                // $speciesLinkData = json_decode($speciesLinkResponse->getBody()->getContents(), true);
                // $speciesLinkData = array_key_exists('results', $speciesLinkData) ?? collect($speciesLinkData['results']);

                // $speciesLinkData->each(function ($newOccurrence) use ($occurrencesIds) {
                //     $occurrence = Occurrence::create(
                //         [
                //             'uuid' => Str::uuid(),
                //             'inaturalist_taxa' => null,
                //             'specieslink_id' => null,
                //             'type' => is_null($newOccurrence['']) ? null : OccurrenceTypes::SpeciesLink->value,
                //             'state_acronym' => strtoupper(trim($acr)),
                //             'state_name' => StatesAcronyms::getStateByAcronym(strtoupper(trim($acr))),
                //             'habitat' => trim($occurrence[2]),
                //             'literature_reference' => null,
                //             'latitude' => null,
                //             'longitude' => null,
                //             'curation' => false
                //         ]
                //     );

                //     $occurrencesIds->add($occurrence->id);
                // });

                $fungi->occurrences()->attach($occurrencesIds->toArray());
                $bar->advance();
            });

            DB::commit();
            $bar->finish();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error($th->getMessage());
            throw $th;
        }
    }
}
