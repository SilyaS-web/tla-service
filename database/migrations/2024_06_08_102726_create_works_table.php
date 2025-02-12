<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogger_id');
            $table->foreign('blogger_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->unsignedBigInteger('project_work_id');
            $table->foreign('project_work_id')->references('id')->on('project_works')->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->string('message', 1000)->nullable();
            $table->timestamp('accepted_by_blogger_at')->nullable();
            $table->timestamp('accepted_by_seller_at')->nullable();
            $table->timestamp('confirmed_by_blogger_at')->nullable();
            $table->timestamp('confirmed_by_seller_at')->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('deals');
    }
}
