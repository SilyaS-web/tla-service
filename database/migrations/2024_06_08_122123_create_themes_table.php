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
                ['theme' => 'Искусство и дизайн'],
                ['theme' => 'Ставки и азартные игры'],
                ['theme' => 'Книги'],
                ['theme' => 'Бизнес и предпринимательство'],
                ['theme' => 'Автомобили и другие транспортные средства'],
                ['theme' => 'Знаменитости и стиль жизни'],
                ['theme' => 'Криптовалюты'],
                ['theme' => 'Культура и события'],
                ['theme' => 'Любопытные факты'],
                ['theme' => 'Каталоги каналов и ботов'],
                ['theme' => 'Экономика и финансы'],
                ['theme' => 'Образование'],
                ['theme' => 'Мода и красота'],
                ['theme' => 'Фитнес'],
                ['theme' => 'Еда и приготовление пищи'],
                ['theme' => 'Изучение иностранного языка'],
                ['theme' => 'Здоровье и медицина'],
                ['theme' => 'История'],
                ['theme' => 'Хобби и занятия'],
                ['theme' => 'Дом и архитектура'],
                ['theme' => 'Юмор и мемы'],
                ['theme' => 'Инвестиции'],
                ['theme' => 'Списки вакансий'],
                ['theme' => 'Дети и воспитание детей'],
                ['theme' => 'Маркетинг и PR'],
                ['theme' => 'Мотивация и саморазвитие'],
                ['theme' => 'Фильмы'],
                ['theme' => 'Музыка'],
                ['theme' => 'Предложения и рекламные акции'],
                ['theme' => 'Домашние животные'],
                ['theme' => 'Политика и инциденты'],
                ['theme' => 'Психология и отношения'],
                ['theme' => 'Недвижимость'],
                ['theme' => 'Отдых и развлечения'],
                ['theme' => 'Религия и духовность'],
                ['theme' => 'Наука'],
                ['theme' => 'Виды спорта'],
                ['theme' => 'Технологии и Интернет'],
                ['theme' => 'Путешествия и туризм'],
                ['theme' => 'Видеоигры'],
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
