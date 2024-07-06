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

        DB::table('tariffs')->insert([
            [
                'title' => 'Стартовый',
                'description' => null,
                'price' => 0,
                'type' => Project::FEEDBACK,
                'quantity' => 1,
                'period' => 7,
                'group_id' => 1,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'СЕЛЛЕР - 10 отзывов',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 10 отзывов на свой товар в течение 30 дней.',
                'price' => 490000,
                'type' => Project::FEEDBACK,
                'quantity' => 10,
                'period' => 30,
                'group_id' => 2,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'БИЗНЕС - 30 отзывов',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 30 отзывов на свой товар в течение 30 дней.',
                'price' => 1350000,
                'type' => Project::FEEDBACK,
                'quantity' => 30,
                'period' => 30,
                'group_id' => 2,
                'is_active' => true,
                'is_best' => true,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'КОМПАНИЯ - 50 отзывов',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 10 отзывов на свой товар в течение 30 дней.',
                'price' => 2000000,
                'type' => Project::FEEDBACK,
                'quantity' => 50,
                'period' => 30,
                'group_id' => 2,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'СЕЛЛЕР - 10 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.',
                'price' => 790000,
                'type' => Project::INSTAGRAM,
                'quantity' => 10,
                'period' => 30,
                'group_id' => 3,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'БИЗНЕС - 30 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.',
                'price' => 2070000,
                'type' => Project::INSTAGRAM,
                'quantity' => 30,
                'period' => 30,
                'group_id' => 3,
                'is_active' => true,
                'is_best' => true,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'КОМПАНИЯ - 50 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.',
                'price' => 2950000,
                'type' => Project::INSTAGRAM,
                'quantity' => 50,
                'period' => 30,
                'group_id' => 3,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'СЕЛЛЕР - 10 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.',
                'price' => 990000,
                'type' => Project::YOUTUBE,
                'quantity' => 10,
                'period' => 30,
                'group_id' => 4,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'БИЗНЕС - 30 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.',
                'price' => 2670000,
                'type' => Project::YOUTUBE,
                'quantity' => 30,
                'period' => 30,
                'group_id' => 4,
                'is_active' => true,
                'is_best' => true,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'КОМПАНИЯ - 50 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.',
                'price' => 3950000,
                'type' => Project::YOUTUBE,
                'quantity' => 50,
                'period' => 30,
                'group_id' => 4,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'СЕЛЛЕР - 10 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.',
                'price' => 790000,
                'type' => Project::VK,
                'quantity' => 10,
                'period' => 30,
                'group_id' => 5,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'БИЗНЕС - 30 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.',
                'price' => 2070000,
                'type' => Project::VK,
                'quantity' => 30,
                'period' => 30,
                'group_id' => 5,
                'is_active' => true,
                'is_best' => true,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'КОМПАНИЯ - 50 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.',
                'price' => 2950000,
                'type' => Project::VK,
                'quantity' => 50,
                'period' => 30,
                'group_id' => 5,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'СЕЛЛЕР - 10 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.',
                'price' => 790000,
                'type' => Project::TELEGRAM,
                'quantity' => 10,
                'period' => 30,
                'group_id' => 6,
                'is_active' => true,
                'is_best' => false,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'БИЗНЕС - 30 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.',
                'price' => 2070000,
                'type' => Project::TELEGRAM,
                'quantity' => 30,
                'period' => 30,
                'group_id' => 6,
                'is_active' => true,
                'is_best' => true,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'КОМПАНИЯ - 50 интеграций',
                'description' => 'Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.',
                'price' => 2950000,
                'type' => Project::TELEGRAM,
                'quantity' => 50,
                'period' => 30,
                'group_id' => 6,
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
        Schema::dropIfExists('tariffs');
    }
}
