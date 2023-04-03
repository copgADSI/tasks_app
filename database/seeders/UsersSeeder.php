<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start_year = Carbon::now()->startOfYear();
        $current_date = Carbon::now();
        $faker = Faker::create();
        foreach (range(1, 50)  as $index) {
            $created_at = $faker->dateTimeBetween($start_year, $current_date);
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt($faker->password()),
                'created_at' => $created_at
            ]);
        }

        /* foreach (range(1, 10)  as $key => $index) {
            $currentKey  = $key + 1;
            User::create([
                'name' => $faker->name(),
                'email' => "admin_{$currentKey}@todo.com",
                'password' => bcrypt('admin123'),
                'role_id' => 1
            ]);
        } */
    }
}
