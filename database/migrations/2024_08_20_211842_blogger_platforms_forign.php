<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BloggerPlatformsForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogger_platforms', function (Blueprint $table) {
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->foreign('platform_id')->references('id')->on('platforms')->cascadeOnDelete();
            $table->dropColumns(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogger_platforms', function (Blueprint $table) {
            $table->dropColumns(['platform_id']);
            $table->string('name')->nullable();
        });
    }
}
