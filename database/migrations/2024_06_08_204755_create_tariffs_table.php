<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('price');
            $table->string('options')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('period')->default(31);
            $table->timestamps();
        });

        // DB::table('tariffs')->insert(
        //     array(
        //         'title' => 'Админ',
        //         'description' => 'admin@adswap.ru',
        //         'price' => '+70000000000',
        //         'options' => '{"options":[]}',
        //         'is_active' => true
        //     ),
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
