<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('countries')->insert(
            [
                ['name' => 'Российская Федерация'],
                // ['name' => 'Азербайджанская Республика'],
                // ['name' => 'Республика Армения'],
                // ['name' => 'Республика Беларусь'],
                // ['name' => 'Республика Казахстан'],
                // ['name' => 'Кыргызская Республика'],
                // ['name' => 'Республика Молдова'],
                // ['name' => 'Республика Таджикистан'],
                // ['name' => 'Республика Узбекистан'],
                // ['name' => 'Украина'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
