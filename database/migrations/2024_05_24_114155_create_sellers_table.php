<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('organization_type')->nullable();
            $table->string('tariff')->default('Пробный');
            $table->integer('is_achievement')->nullable();
            $table->integer('remaining_tariff')->default(1);
            $table->integer('is_agent')->default(0);
            $table->string('inn', 50)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('platform')->nullable();
            $table->timestamp('finish_date')->nullable();
            $table->string('platform_link')->nullable();
            $table->string('wb_api_key')->nullable();
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
        Schema::dropIfExists('sellers');
    }
}
