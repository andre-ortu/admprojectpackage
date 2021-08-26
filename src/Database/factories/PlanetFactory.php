<?php

namespace AndreaOrtu\AdmProject\Database\factories;

use AndreaOrtu\AdmProject\Models\Planet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Planet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "diameter" => "10465",
            "rotation_period" => "23",
            "orbital_period" => "304",
            "gravity" => "1 standard",
            "population" => "200000",
            "climate" => "arid",
            "terrain" => "desert",
            "surface_water" => "1",
            "residents" => [
                "https://swapi.dev/api/people/1/",
                "https://swapi.dev/api/people/2/",
                "https://swapi.dev/api/people/4/",
                "https://swapi.dev/api/people/6/",
                "https://swapi.dev/api/people/7/",
                "https://swapi.dev/api/people/8/",
                "https://swapi.dev/api/people/9/",
                "https://swapi.dev/api/people/11/",
                "https://swapi.dev/api/people/43/",
                "https://swapi.dev/api/people/62/"
            ],
            "films" => [
                "https://swapi.dev/api/films/1/",
                "https://swapi.dev/api/films/3/",
                "https://swapi.dev/api/films/4/",
                "https://swapi.dev/api/films/5/",
                "https://swapi.dev/api/films/6/"
            ],
            "url" => "https://swapi.dev/api/planets/1/",
            "created" => "2014-12-09T13:50:49.641000Z",
            "edited" => "2014-12-20T20:58:18.411000Z",
            "created_at" => "2021-08-21T22:18:39.000000Z",
            "updated_at" => "2021-08-21T22:18:39.000000Z"
        ];
    }

}
