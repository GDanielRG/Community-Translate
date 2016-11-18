<?php

	namespace App\Http;

	use App\Key;
	use App\State;
	use App\Language;
	use App\TranslationRequest;
	use App\TranslationPetition;
	use App\Message;

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

		public function createRequest()
		{
			if($this->user && $this->user->canRequestTranslation()){

				$this->goRequesTranslation();
				$lang = explode(" ", $this->payload);
				$text = substr($this->payload, strlen($lang[0]) + 1);


				$language = Language::where('code', $lang[0])->orWhere('name', $lang[0])->first();

				if($language)
				{
					TranslationRequest::create(	[	'user_id' => $this->user->id,
					'language_id' => $language->id,
					'text' => $text,
					'closed' => false,
					'last_petition' => \Carbon\Carbon::now()

				]);

				$message = new Message(['message' => trans('messages.request_done')]);
				$this->user->messages()->save($message);
				}

				$this->updateLastPlatform();

			}
		}

		public function recievePetition($idPetition)
		{
			$this->goPetitionTranslation();
			$translationPetition = TranslationPetition::find($idPetition);
			$language = $translationPetition->language->name;

			$message = new Message(['message' => trans('messages.request_translate_petition', ['lang'=>$language->name, 'text'=> $translationPetition->translationRequest->text])]);
			$translationPetition->user->messages()->save($message);

			$translationPetition->sent = true;
			$translationPetition->save();
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
