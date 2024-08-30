<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BloggerPlatformsForign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogger_platforms', function (Blueprint $table) {
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->foreign('platform_id')->references('id')->on('platforms')->cascadeOnDelete();
        });

        DB::table('blogger_platforms')->where('name', 'Telegram')->update(['platform_id' => 1]);
        DB::table('blogger_platforms')->where('name', 'Youtube')->update(['platform_id' => 2]);
        DB::table('blogger_platforms')->where('name', 'Instagram')->update(['platform_id' => 3]);
        DB::table('blogger_platforms')->where('name', 'VK')->update(['platform_id' => 4]);

        Schema::table('blogger_platforms', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogger_platforms', function (Blueprint $table) {
            $table->dropColumn('platform_id');
            $table->string('name')->nullable();
        });
    }
}
