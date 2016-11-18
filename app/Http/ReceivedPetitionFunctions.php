<?php

	namespace App\Http;

	use App\Key;
	use App\Message;
	use App\TranslationPetition;
	use App\TranslationAnswer;

	/**
	*
	*/
	class ReceivedPetitionFunctions extends GlobalFunctions
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


		public function sendAnswerr()
		{
			\Log::info('entro');
			// if($this->user && $this->user->canAnswer()){
			//
			// 	$text = $this->payload;
			//
			// 	$petition = $this->user->translationPetitions()->where('closed', false)->first();
			// 	$petition->translationAnswers()->save(new TranslationAnswer(["translation" => $text]));
			// 	$petition->closed = true;
			// 	$petition->save();
			//
			// 	if($petition->translationRequest->user->canReceiveAnswers())
			// 	{
			// 		$message = new Message(['message' => trans('reply_label', ["language" => $petition->language->name, "translation" => $text])]);
			// 		$targetUserId = $petition->translationRequest()->user();
			//
			// 		$targetUserId->messages()->save($message);
			// 	}
			//
			// 	$this->close();
			//
			// }
		}

	}
