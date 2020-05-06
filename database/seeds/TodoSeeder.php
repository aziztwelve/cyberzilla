<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Todo');

        for ($i = 1; $i <=1000; $i ++ ) {
            DB::table('todos')->insert([
               'title' => $faker->sentence,
               'content' => implode($faker->paragraphs(5)),
               'user_id' => App\User::all()->random()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
