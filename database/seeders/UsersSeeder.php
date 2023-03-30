<?php

namespace Database\Seeders;

use App\Models\User;
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
        $faker = Faker::create();
        foreach (range(1, 50)  as $index) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt($faker->password()),
            ]);
        }

        foreach (range(1, 10)  as $key => $index) {
            $currentKey  = $key+ 1;
            User::create([
                'name' => $faker->name(),
                'email' => "admin_{$currentKey}@todo.com",
                'password' => bcrypt('admin123'),
            ]);
        }
    }
}
