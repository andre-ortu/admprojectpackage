<?php

namespace AndreaOrtu\AdmProject\Commands;

use AndreaOrtu\AdmProject\Models\People;
use AndreaOrtu\AdmProject\Models\Planet;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class StorePeopleAndPlanet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:people-and-planet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve data from swapi.dev and store into db';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $swapiUrl = People::SWAPI_API;

        try {
            do {
                $peoples = (Http::get($swapiUrl))->json();

                $swapiUrl = $this->getNextPage($peoples);
                foreach ($peoples['results'] as $people) {
                    $planet = $this->insertPlanet($people['homeworld']);
                    $this->insertPeople($people, $planet);
                }

            } while (! is_null($swapiUrl) && ! App::environment('testing'));

            $this->info('Peoples and planets inserted!');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }

    private function insertPlanet($swapiePlanetUrl)
    {
        $planet = (Http::get($swapiePlanetUrl))->json();

        return Planet::firstOrCreate(
            ['name' => $planet['name']],
            $planet
        );
    }

    private function insertPeople($people, $planet)
    {
        $people['planet_id'] = $planet['id'];
        People::create($people);
    }

    private function getNextPage($peoples)
    {
        return Arr::has($peoples, 'next') ? $peoples['next'] : "";
    }
}
