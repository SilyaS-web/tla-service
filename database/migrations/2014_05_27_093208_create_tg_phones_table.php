<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTgPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg_phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->bigInteger('chat_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('tg_phones')->insert(
            array(
                'phone' => '+70000000001',
                'chat_id' => 0,
            )
        );

        DB::table('tg_phones')->insert(
            array(
                'phone' => '+70000000000',
                'chat_id' => 0,
            )
        );

        DB::table('tg_phones')->insert(
            array(
                'phone' => '+71111111111',
                'chat_id' => 0,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tg_phones');
    }
}
