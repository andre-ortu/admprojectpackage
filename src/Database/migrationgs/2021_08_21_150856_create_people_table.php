<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrationgs.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('birth_year');
            $table->string('eye_color');
            $table->string('gender');
            $table->string('hair_color');
            $table->string('height');
            $table->string('mass');
            $table->string('skin_color');
            $table->string('homeworld');
            $table->json('films');
            $table->json('species');
            $table->json('starships');
            $table->json('vehicles');
            $table->string('url');
            $table->string('created');
            $table->string('edited');
            $table->unsignedBigInteger('planet_id');
            $table->timestamps();

            $table->foreign('planet_id')
                ->references('id')
                ->on('planets');
        });
    }

    /**
     * Reverse the migrationgs.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
