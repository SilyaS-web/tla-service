<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->string('type');
            $table->integer('quantity');
            $table->integer('period')->default(31);
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('tariff_groups')->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_best')->default(false);
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
        Schema::dropIfExists('tariffs');
    }
}
