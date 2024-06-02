<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tg_phones')->insert([
            [
                'phone' => '+70000000000',
                'chat_id'  => '470155536',
            ], [
                'phone' => '+71111111111',
                'chat_id'  => '470155536',
            ], [
                'phone' => '+73333333333',
                'chat_id'  => '470155536',
            ]
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
