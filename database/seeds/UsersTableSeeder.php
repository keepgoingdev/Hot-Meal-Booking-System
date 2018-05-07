<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'is_admin' => true,
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456')
        ]);
    }
}
