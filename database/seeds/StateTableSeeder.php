<?php

use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$stateNames = [
    		'main',
    		'requestedTranslation',
    		'receivedPetition',
    		'rating',
    		'requestFromImage'
    	];

        foreach ($stateNames as $name) {
        	State::create(['name' => $name]);
        }
    }
}
