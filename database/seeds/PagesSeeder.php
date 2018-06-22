<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('pages')->insert([
            [
                'title' => 'Главная',
                'content' => '',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
        ]);

       DB::table('seos')->insert([
           [
               'document_id' => 1,
               'document_type' => 'App\Models\Page',
               'title' => 'Главная',
               'keywords' => 'examlpe',
               'description' => 'examlpe',
               'seo_title' => '',
               'seo_text' => '',
               'created_at' => Carbon\Carbon::now(),
               'updated_at' => Carbon\Carbon::now(),
           ],
       ]);
    }
}
