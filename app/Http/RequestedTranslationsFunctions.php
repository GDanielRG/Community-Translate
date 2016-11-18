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
			 if($this->user && $this->user->canGetBestAnswer()){

			 	$request = $this->user->translationRequests()->where('closed', false)->first();

				// 	\Log::info("Petition");
				// 	\Log::info($petition);

			 	$answers = $request->translationAnswers;
				$highestRated = $answers->first();
				$countHighest = 0;
				foreach ($answers as $answer) {
					 # code...

					$rates = $answer->rates;

					$count = 0;
					foreach ($rates as $rate ) {
						$count = $count + $rate->value;
					}
					if ( $count >= $countHighest) {
						$highestRated = $answer;
						$countHighest = $count;
					}
				}
				$message = new Message(['message' => trans('messages.best_translation', ['text'=>$highestRated->translation])]);
				$this->user->messages()->save($message);
			 }
		}


	}
