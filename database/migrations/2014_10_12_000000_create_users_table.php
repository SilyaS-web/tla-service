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
            $table->string('phone')->unique();
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

        DB::table('users')->insert(
            array(
                'id' => 0,
                'name' => 'Системное сообщение',
                'email' => 'system@adswap.ru',
                'phone' => '+70000000001',
                'role' => 'admin',
                'password' => bcrypt('systempassword'),
                'status' => 1,
                'tg_phone_id' => 1,
            ),
        );

        DB::table('users')->insert(
            array(
                'id' => 0,
                'name' => 'Админ',
                'email' => 'admin@adswap.ru',
                'phone' => '+70000000000',
                'role' => 'admin',
                'password' => bcrypt('adminpassword'),
                'status' => 1,
                'tg_phone_id' => 2,
            ),
        );
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
