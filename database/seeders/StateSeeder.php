<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = State::STATES;
        for ($i=0; $i < count($states) ; $i++) { 
            $current_state = State::where('type', '=', $states[$i])->first();
            if (!is_null($current_state)) {
                continue;
            }
            State::create([
                'type' => $states[$i]
            ]);
        }
    }
}
