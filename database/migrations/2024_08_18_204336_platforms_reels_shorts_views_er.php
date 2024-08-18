<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlatformsReelsShortsViewsEr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogger_platforms', function (Blueprint $table) {
            $table->integer('additional_coverage')->nullable();
            $table->double('additional_engagement_rate')->nullable();
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
            $table->dropColumns(['additional_coverage', 'additional_engagement_rate']);
        });
    }
}
