<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectsWbStatsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('wb_category')->nullable();
            $table->string('wb_product_name', 500)->nullable();
            $table->string('wb_description', 2500)->nullable();
            $table->text('wb_options')->nullable();
            $table->unsignedInteger('wb_rate')->nullable();
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
            $table->dropColumn(['wb_category', 'wb_product_name', 'wb_description', 'wb_options' , 'wb_rate']);
        });
    }
}
