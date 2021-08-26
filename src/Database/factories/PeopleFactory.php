<?php

namespace AndreaOrtu\AdmProject\Database\factories;

use AndreaOrtu\AdmProject\Models\People;
use AndreaOrtu\AdmProject\Models\Planet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "birth_year" => "19BBY",
            "eye_color" => "blue",
            "gender" => "male",
            "hair_color" => "blond",
            "height" => "172",
            "mass" => "77",
            "skin_color" => "fair",
            "homeworld" => "https://swapi.dev/api/planets/1/",
            "films" => [
                "https://swapi.dev/api/films/1/",
                "https://swapi.dev/api/films/2/",
                "https://swapi.dev/api/films/3/",
                "https://swapi.dev/api/films/6/"
            ],
            "species" => [],
            "starships" => [
                "https://swapi.dev/api/starships/12/",
                "https://swapi.dev/api/starships/22/"
            ],
            "vehicles" => [
                "https://swapi.dev/api/vehicles/14/",
                "https://swapi.dev/api/vehicles/30/"
            ],
            "url" => "https://swapi.dev/api/people/1/",
            "created" => "2014-12-09T13:50:51.644000Z",
            "edited" => "2014-12-20T21:17:56.891000Z",
            "planet_id" => Planet::factory()->create()->id,
            "created_at" => "2021-08-21T22:18:39.000000Z",
            "updated_at" => "2021-08-21T22:18:39.000000Z",
        ];
    }
}
