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

        DB::table('tg_phones')->insert([
            [
                'phone' => '+70000000001', // 1
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+70000000000', // 2
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+79998880001', // 3
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+79998880002', // 4
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+79998880003', // 5
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+79998880004', // 6
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+79998880005', // 7
                'chat_id' => 470155536,
            ],
            [
                'phone' => '+79998880006', // 8
                'chat_id' => 470155536,
            ]
        ]);
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
