<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_nm');
            $table->string('product_link', 1000);
            $table->double('product_price');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('marketplace_brand')->nullable();
            $table->string('marketplace_category')->nullable();
            $table->string('marketplace_product_name', 1000)->nullable();
            $table->text('marketplace_description')->nullable();
            $table->text('marketplace_options')->nullable();
            $table->unsignedInteger('marketplace_rate')->nullable();
            $table->boolean('is_blogger_access')->nullable()->default(false);
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
        Schema::dropIfExists('projects');
    }
}
