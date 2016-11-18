<?php

	namespace App\Http;

	use App\Key;
	use App\State;
	use App\Language;
	use App\TranslationRequest;

	/**
	* 
	*/
	class RatingFunctions extends GlobalFunctions
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

		public function rateAnswer()
		{
			if($this->user){

				$value = $this->payload;

				switch ($value) {
					case 1:
					case -1:
					case 0:
						# code...
						$rate = $this->user->rates()->where('value', null)->first();
						if ($rate) {
							$rate->value = $value;
							$rate->save();
						}
					break;
					
					
					default:
						# code...
						break;
				}

			}
		}

		public function skip()
		{
			$rate = $this->user->rates()->where('value', null)->first();
			if ($rate) {
				$rate->value = 0;
				$rate->save();
			}
		}
	}