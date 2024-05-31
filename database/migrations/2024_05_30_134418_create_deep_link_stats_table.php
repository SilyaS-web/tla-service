<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeepLinkStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deep_link_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id');
            $table->foreign('link_id')->references('id')->on('deep_links')->cascadeOnDelete();
            $table->timestamp('datatime')->nullable();
            $table->string('device')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('country')->nullable();
            $table->string('federal_district')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('referrer')->nullable();
            $table->integer('is_bot')->nullable();
            $table->integer('is_mobile')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deep_link_stats');
    }
}
