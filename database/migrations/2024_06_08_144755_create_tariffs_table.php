<?php

use App\Models\Project;
use Carbon\Carbon;
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
            $table->boolean('is_start')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_best')->default(false);
            $table->timestamps();
        });

        DB::table('tariffs')->insert([
            [
                'title' => 'Пробный',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению бартеров на свой товар в течение 30 дней.',
                'price' => 0,
                'type' => Project::BARTER,
                'quantity' => 3,
                'period' => 14,
                'is_start' => true,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Безлимит',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению бартеров на свой товар в течение 30 дней.',
                'price' => 249000,
                'type' => Project::BARTER,
                'quantity' => -1,
                'period' => 30,
                'is_start' => true,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
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
