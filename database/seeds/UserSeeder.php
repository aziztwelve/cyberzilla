<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'user@gmail.com',
            'phone'=> "+79111111111",
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'user2@gmail.com',
            'phone'=> "+79111111111",
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'user1@gmail.com',
            'phone'=> "+79111111111",
            'password' => bcrypt('123456'),
        ]);
    }
}
