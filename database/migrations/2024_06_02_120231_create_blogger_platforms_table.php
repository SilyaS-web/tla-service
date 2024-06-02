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
            $table->foreign('blogger_id')->references('id')->on('bloggers')->cascadeOnDelete();
            $table->string('name');
            $table->integer('subscriber_quantity');
            $table->integer('coverage');
            $table->double('engagement_rate');
            $table->double('cost_per_mille');
            $table->timestamps();
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
