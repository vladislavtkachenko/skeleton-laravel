<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'super_admin@admin.ru',
                'password' => bcrypt('secret'),
                'is_super_admin' => 1,
                'is_admin' => 1,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.ru',
                'password' => bcrypt('secret'),
                'is_super_admin' => 0,
                'is_admin' => 1,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
        ]);

        factory(App\Models\User::class, 3)->create();
    }
}
