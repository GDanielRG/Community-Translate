<?php

	namespace App\Http;

	use App\Key;
	use App\State;

	/**
	* 
	*/
	class MainFunctions extends GlobalFunctions
	{
		
		protected $user;
		protected $payload;
		protected $service;
		protected $serviceId;

		function __construct($service, $userId, $payload)
		{
			$key = Key::where('key', $userId)->where('name', $service)->first();
			$this->user = $key ? $key->user : null;
			$this->payload = $payload;
			$this->service = $service;
			$this->serviceId = $userId;
		}

		// Go to state 4
		public function goRate()
		{
			if($this->user){
				$state = State::where('name', 'rating')->first();
				$this->user->state_id = $state->id;
				$this->user->save();
			}
		}
		
		// Go to state 2
		public function goRequesTranslation()
		{
			//MISSING QUERY
			if($this->user){
				$state = State::where('name', 'requestedTranslation')->first();
				$this->user->state_id = $state->id;
				$this->user->save();
			}
		}

		// Go to state 5
		public function goRequesTranslationImage()
		{
			//MISSING QUERY
			if($this->user){
				$state = State::where('name', 'requestedFromImage')->first();
				$this->user->state_id = $state->id;
				$this->user->save();
			}
		}

		// Go to state 3
		public function goPetitionTranslation()
		{

			if($this->user){
				$state = State::where('name', 'receivedPetition')->first();
				$this->user->state_id = $state->id;
				$this->user->save();
			}
		}
	}