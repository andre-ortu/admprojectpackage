<?php

namespace AndreaOrtu\AdmProject\Test;

use AndreaOrtu\AdmProject\AdmProjectServiceProvider;
use AndreaOrtu\AdmProject\Models\People;
use AndreaOrtu\AdmProject\Models\Planet;
use Orchestra\Testbench\TestCase;

class PeopleTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }

    protected function getPackageProviders($app)
    {
        return [AdmProjectServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
//    /** @test */
//    public function a_command_create_peoples_and_planet()
//    {
//        $this->artisan('store:people-and-planet')
//            ->expectsOutput('Peoples and planets inserted!');
//    }

    /**
     * @test
     * Retrieve People
     **/
    public function retrieve_people()
    {
        $this->get('/api/people')
            ->assertJsonStructure([
                "current_page",
                "data",
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "links",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total"
            ])
            ->assertOk();
    }

    /**
     * @test
     * Filter
     **/
    public function retrieve_people_with_brown_eyes()
    {
        People::factory()->create([
            "eye_color" => "brown"
        ]);
        People::factory()->create([
            "eye_color" => 'blue'
        ]);

        $this->get('/api/people?filter=["eye_color", "brown"]')
            ->assertJsonFragment([
                "eye_color" => "brown"
            ])
            ->assertJsonMissing([
                "eye_color" => "blue"
            ])
            ->assertOk();
    }

    /**
     * @test
     * Sort
     **/

    public function sort_people_by_name()
    {
        People::factory()->create([
            "name" => "Luca",
        ]);
        People::factory()->create([
            "name" => 'Andrea',
        ]);
        $response = $this->get('/api/people?sortBy=name&direction=asc')
            ->assertOk()
            ->json();

        $this->assertTrue($response['data'][0]['name'] == 'Andrea');
        $this->assertTrue($response['data'][1]['name'] == 'Luca');
    }

    /** @test */
    public function a_people_has_a_planet_information()
    {
        $planet = Planet::factory()->create();
        $peoples = People::factory()->count(5)->create([
            "planet_id" => $planet->id,
        ]);

        $response = $this->get('/api/people/' . $peoples[0]->id)
            ->assertOk()
            ->json();

        $this->assertTrue($response['planet']['name'] == $planet->name);
    }

    /** @test */
    public function people_not_found()
    {
        $planet = Planet::factory()->create();
        $peoples = People::factory()->count(5)->create([
            "planet_id" => $planet->id,
        ]);

        $response = $this->get('/api/people/1000')
            ->assertStatus(404)
            ->assertJson([
                'error' => 'People Not Found'
            ]);
    }

}
