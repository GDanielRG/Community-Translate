<?php

	namespace App\Http;

	use App\Message;
	use App\State;
	use App\User;
	use App\Key;
	use App\Language;

	/**
	*
	*/
	class GlobalFunctions
	{

		/**
		*	Command;
		*	#register {id} {password}
		*/
		public function register()
		{

			// Check if user is not null user
			// Check if the user key exists for this service

			$params = explode(" ", $this->payload);

			$appId = $params[0];
			$password = $params[1];

			if(!$this->user)
				$this->user=User::where('username', $appId)->first();

			if($this->user){

				if(\Hash::check($password, $this->user->password)){


					// Update the last active platform
					$this->user->lastActivePlatform = $this->service;
					$this->user->save();

					// Check if the service is not already registered
					$key = $this->user->keys()->where('name', $this->service)->first();

					if(!$key) {
						$this->user->keys()->save(new Key([	'name' => $this->service,
																	'key' => $this->serviceId]));
					} else {
						$key->key = $this->serviceId;
						$key->save();
					}

					$message = new Message(['message' => trans('messages.new_service_added')]);
					$this->user->messages()->save($message);

				} else {

					// Create error message, wrong password

					$message = new Message(['message' => trans('messages.wrong_password')]);
					$this->user->messages()->save($message);

				}

			} else {

				// Create a new user

				\Log::info("On new user");

				$state = State::where('name', 'main')->first();

				$this->user =  User::create([	'username' => $appId,
												'password' => bcrypt($password),
												'lastActivePlatform' => $this->service,
												'state_id' => $state->id]);

				// Register the new user key
				$this->user->keys()->save(new Key([	'name' => $this->service,
															'key' => $this->serviceId]));

				$message = new Message(['message' => trans('messages.new_user_registered')]);
				$this->user->messages()->save($message);

			}
		}

		/**
		*	Command;
		*	#mute
		*/
		public function muteMessages(){
			if($this->user){
				$this->user->mute = true;
				$this->user->save();
			} else {
				$this->userNotFound();
			}
		}

		/**
		*	Command:
		*	#unmute
		*/
		public function unmuteMessages(){
			if($this->user){
				$this->user->mute = false;
				$this->user->save();
			} else {
				$this->userNotFound();
			}
		}

		
		/**
		* Command:
		* #help
		*/
		public function askHelp(){

			if($this->user){

				$actualState = $this->user->state;
				$stateName = $actualState->name;
				$messageId = "";

				switch ($stateName) {
					case 'main':
						$messageId = "messages.main_help_text";
						break;

					case 'requestedTranslation':
						$messageId = "messages.requested_help_text";
						break;

					case 'receivedPetition':
						$messageId = "messages.received_help_text";
						break;

					case 'rating':
						$messageId = "messages.rating_help_text";
						break;

					case 'requestFromImage':
						$messageId = "messages.requested_image_help_text";
						break;			

					default:
						// Error, send generic message
						$message = new Message(['message' => trans('messages.no_help_available')]);
						$this->user->messages()->save($message);
						return;
				}

				$message = new Message(['message' => trans('available_commands').trans($messageId).trans('global_help_text')]);
				$this->user->messages()->save($message);

			} else {

				$this->userNotFound();
			}

		}


		public function userNotFound()
		{
				//SendMessageUsernotFound
		}

		public function addLanguage()
		{
			if($this->user)
			{
				$this->user->lastActivePlatform = $this->service;
				$this->user->save();

				$language = Language::where('name', $this->payload)->orWhere('code', $this->payload)->first();
				if($language)
				{
					$this->user->languages()->attach($language->id);
					$message = new Message(['message' => trans('messages.new_language_added', ['name'=>$language->name])]);
					$this->user->messages()->save($message);
				}
				else{
					$message = new Message(['message' => trans('messages.language_not_found', ['name'=>$this->payload])]);
					$this->user->messages()->save($message);
				}
			}
			else{
				$this->userNotFound();
			}
		}

		public function changeLanguage()
		{
			if($this->user)
			{
				$this->user->lastActivePlatform = $this->service;
				$this->user->save();

				$language = $this->user->languages()->where('name', $this->payload)->orWhere('code', $this->payload)->first();
				if($language)
				{
					$this->user->language->save($language);
					$message = new Message(['message' => trans('messages.language_changed', ['name'=>$language->name])]);
					$this->user->messages()->save($message);
				}
				else{
					$message = new Message(['message' => trans('messages.language_not_present', ['name'=>$this->payload])]);
					$this->user->messages()->save($message);
				}
			}
			else{
				$this->userNotFound();
			}
		}

		public function close()
		{
			// Check that the users exits
			if($this->user){
				$actualState = $this->user->state;
				$stateName = $actualState->name;

				// Change the state only if the user is on state different than Main
				if($stateName != 'main'){

					switch ($stateName) {
						case 'rating':
							// Do logic
							break;
						
						default:
							break;
					}

					// Change the state to main
					$state = State::where('name', 'main')->first();
					$this->user->state_id = $state->id;
					$this->user->save();
				}

			}
		}
	}
