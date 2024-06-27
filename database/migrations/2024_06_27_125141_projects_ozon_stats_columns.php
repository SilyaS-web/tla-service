<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectsOzonStatsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('ozon_brand')->nullable();
            $table->string('ozon_category')->nullable();
            $table->string('ozon_product_name', 500)->nullable();
            $table->string('ozon_description', 2500)->nullable();
            $table->text('ozon_options')->nullable();
            $table->unsignedInteger('ozon_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['ozon_brand', 'ozon_category', 'ozon_product_name', 'ozon_description', 'ozon_options' , 'ozon_rate']);
        });
    }
}
