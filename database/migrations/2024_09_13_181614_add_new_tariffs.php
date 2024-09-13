<?php

use App\Models\Project;
use App\Models\Tariff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNewTariffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Tariff::where('id', '<>', 1)->update([
            'is_active' => false,
            'is_best' => false,
        ]);

        DB::table('tariffs')->insert([
            [
                'title' => 'Отзывы',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению отзывов на свой товар в течение 30 дней.',
                'price' => 0,
                'type' => Project::FEEDBACK,
                'quantity' => 0,
                'period' => 30,
                'group_id' => 2,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'Интеграции',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению интеграций на свой товар в течение 30 дней.',
                'price' => 0,
                'type' => Project::INTEGRATIONS,
                'quantity' => 0,
                'period' => 30,
                'group_id' => 2,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
