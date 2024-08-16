<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->timestamps();
        });

        DB::table('themes')->insert(
            [
                ['theme' => 'Автомобили'],
                ['theme' => 'Авторский блог'],
                ['theme' => 'Бизнес, предприниматель'],
                ['theme' => 'Дети, семья и отношения'],
                ['theme' => 'Дом, сад и огород'],
                ['theme' => 'Дизайн и фотография'],
                ['theme' => 'Дизайн интерьера, ремонт'],
                ['theme' => 'Еда и кафе'],
                ['theme' => 'Животные'],
                ['theme' => 'Жизнь за границей'],
                ['theme' => 'Здоровье и медицина'],
                ['theme' => 'Игры'],
                ['theme' => 'Инвестиции'],
                ['theme' => 'Искусство'],
                ['theme' => 'Книги и чтение'],
                ['theme' => 'Красота и косметика'],
                ['theme' => 'Лайфстайл'],
                ['theme' => 'Маркетинг, smm, pr'],
                ['theme' => 'Мода и шопинг'],
                ['theme' => 'Мотивация и саморазвитие'],
                ['theme' =>' Наука и технологии'],
                ['theme' => 'Недвижимость'],
                ['theme' => 'Региональные'],
                ['theme' => 'Рукоделие, DIY'],
                ['theme' => 'Скидки и акции'],
                ['theme' => 'Спорт'],
                ['theme' => 'Строительство и ремонт'],
                ['theme' => 'Сфера IT'],
                ['theme' => 'Театр, кино и аниме'],
                ['theme' => 'Туризм и путешествия'],
                ['theme' => 'Медитация, тренировки'],
                ['theme' => 'Хобби, отдых и развлечения'],
                ['theme' => 'Экономика и финансы'],
                ['theme' => 'Юмор и мемы'],
                ['theme' => 'Юриспруденция'],
                ['theme' => 'Другое'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
