<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_works', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('quantity');
            $table->unsignedBigInteger('project_id');
            $table->timestamp('finish_date')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
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
        Schema::dropIfExists('project_works');
    }
}
