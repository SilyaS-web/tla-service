<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subs');
            $table->unsignedBigInteger('views');
            $table->unsignedBigInteger('reposts');
            $table->unsignedBigInteger('likes');
            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id')->references('id')->on('works')->cascadeOnDelete();
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id')->references('id')->on('messages')->cascadeOnDelete();
            $table->string('platform')->nullable();
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
        Schema::dropIfExists('finish_stats');
    }
}
