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
               'title' => 'example',
               'key' => 'example_key',
               'value' => 'example_value',
            ],
        ]);
    }
}
