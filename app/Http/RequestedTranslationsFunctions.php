<?php

	namespace App\Http;

	use App\Key;
	use App\TranslationRequest;

	/**
	* 
	*/
	class RequestedTranslationsFunctions extends GlobalFunctions
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

		public function getBestAnswer()
		{
			// if($this->user){

			// 	$petition = $this->user->translationPetitions()->where('closed', false)->first();

			// 	\Log::info("Petition");
			// 	\Log::info($petition);
				
			// 	$answers = $petition->translationAnswers();


			// 	\Log::info("Answers");
			// 	\Log::info($answers);
			// }
		}
		

	}