<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ConfigsSeeder::class);
         $this->call(PagesSeeder::class);
         $this->call(UsersSeeder::class);
    }
}
