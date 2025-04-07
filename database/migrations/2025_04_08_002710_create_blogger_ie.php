<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bloggers', function (Blueprint $table) {
            $table->boolean('is_ie')->default(false);
            $table->integer('balance')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bloggers', function (Blueprint $table) {
            $table->dropColumn('is_ie');
            $table->dropColumn('balance');
        });
    }
};
