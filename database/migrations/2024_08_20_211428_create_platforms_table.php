<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('platforms')->insert([
            [
                'title' => 'Telegram', // 1
                'image' => 'img/telegram-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'Youtube', // 2
                'image' => 'img/youtube-colored-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'Instagram', // 3
                'image' => 'img/inst-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'VK', // 4
                'image' => 'img/vk-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'Yappy', // 5
                'image' => 'img/yappy-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'Dzen', // 6
                'image' => 'img/ya-dzen-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'OK', // 7
                'image' => 'img/ok-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'Rutube', // 8
                'image' => 'img/rutube-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                'title' => 'Tiktok', // 9
                'image' => 'img/tiktok-icon.svg',
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
