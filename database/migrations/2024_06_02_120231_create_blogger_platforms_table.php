<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloggerPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogger_platforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogger_id');
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->foreign('platform_id')->references('id')->on('platforms')->cascadeOnDelete();
            $table->foreign('blogger_id')->references('id')->on('bloggers')->cascadeOnDelete();
            $table->string('link');
            $table->integer('subscriber_quantity')->nullable();
            $table->integer('coverage')->nullable();
            $table->integer('additional_coverage')->nullable();
            $table->double('engagement_rate')->nullable();
            $table->double('additional_engagement_rate')->nullable();
            $table->double('cost_per_mille')->nullable();
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
        Schema::dropIfExists('blogger_platforms');
    }
}
