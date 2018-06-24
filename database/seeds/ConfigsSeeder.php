<?php

use Illuminate\Database\Seeder;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('configs')->insert([
            [
               'title' => 'Email администратора',
               'key' => 'admin',
               'value' => 'vladislav.tkachenko@rocketstation.ru',
            ],
        ]);
    }
}
