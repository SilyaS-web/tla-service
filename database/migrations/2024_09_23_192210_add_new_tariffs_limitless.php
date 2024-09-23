<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;
use App\Models\Tariff;
use Illuminate\Support\Facades\DB;

class AddNewTariffsLimitless extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Tariff::where('id', '<>', 0)->update([
            'is_active' => false,
            'is_best' => false,
        ]);

        DB::table('tariff_groups')->insert([
            [
                'title' => 'Безлимит', // 9
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],
        ]);

        DB::table('tariffs')->insert([
            [
                'title' => 'Пробный',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению бартеров на свой товар в течение 30 дней.',
                'price' => 0,
                'type' => Project::BARTER,
                'quantity' => 5,
                'period' => 30,
                'group_id' => 1,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'Безлимит',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению бартеров на свой товар в течение 30 дней.',
                'price' => 499000,
                'type' => Project::BARTER,
                'quantity' => -1,
                'period' => 30,
                'group_id' => 9,
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
