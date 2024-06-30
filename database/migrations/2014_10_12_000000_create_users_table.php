<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 30)->unique();
            $table->string('image')->nullable();
            $table->string('role');
            $table->string('password');
            $table->integer('status')->default(0);
            $table->timestamp('telegram_verified_at')->nullable();
            $table->unsignedBigInteger('tg_phone_id');
            $table->foreign('tg_phone_id')->references('id')->on('tg_phones')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            [
                'name' => 'Системное сообщение', // 1
                'email' => 'system@adswap.ru',
                'phone' => '+7 (000) 000-00-01',
                'role' => 'admin',
                'password' => bcrypt('systempassword'),
                'status' => 1,
                'tg_phone_id' => 1,
            ],
            [
                'name' => 'Админ', // 2
                'email' => 'admin@adswap.ru',
                'phone' => '+7 (000) 000-00-00',
                'role' => 'admin',
                'password' => bcrypt('adminpass'),
                'status' => 0,
                'tg_phone_id' => 2,
            ],
            [
                'name' => 'Блогер 1', // 3
                'email' => 'blogger1@adswap.ru',
                'phone' => '+7 (999) 888-00-01',
                'role' => 'blogger',
                'password' => bcrypt('bloggerpass'),
                'status' => 0,
                'tg_phone_id' => 3,
            ],
            [
                'name' => 'Блогер 2', // 4
                'email' => 'blogger2@adswap.ru',
                'phone' => '+7 (999) 888-00-02',
                'role' => 'blogger',
                'password' => bcrypt('bloggerpass'),
                'status' => 0,
                'tg_phone_id' => 4,
            ],
            [
                'name' => 'Селлер 1', // 5
                'email' => 'seller@adswap.ru',
                'phone' => '+7 (999) 888-00-03',
                'role' => 'seller',
                'password' => bcrypt('sellerpass'),
                'status' => 0,
                'tg_phone_id' => 5,
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
        Schema::dropIfExists('users');
    }
}
