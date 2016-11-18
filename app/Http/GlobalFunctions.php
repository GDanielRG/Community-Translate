<?php

	namespace App\Http;

	use App\Message;

	/**
	* 
	*/
	class GlobalFunctions
	{
		
		/**
		*	#register {id} {password}
		*/
		

		public function register()
		{

			// Check if user is not null user
			// Check if the user key exists for this service

			$params = explode(" ", $this->payload);

			$appId = $params[0];
			$password = $params[1];


			if($this->user){

				if(\Hash::check($password, $this->user->password)){

					// Check if the service is not already registered
					$key = $this->user->keys()->where('name', $this->service)->first();

					if(!$key) {
						$this->user->keys()->save(new Key::create([	'name' => $this->service, 
																	'key' => $this->sericeId]));
					} else {
						$key->key = $this->serviceId;
						$key->save();
					}


				} else {

					// Create error message, wrong password

					$message = new Message(['message' => trans('messages.wrong_password')]);
					$this->user->messages->save($message);

				}

			} else {

				// Create a new user

				$state = State::where('name', 'main')->first();

				$this->user =  User::create([	'username' => $appId, 
												'password' => bcrypt($password), 
												'lastActivePlatform' => $this->service, 
												'state_id' => $state->id]);

				// Register the new user key
				$this->user->keys()->save(new Key::create([	'name' => $this->service, 
															'key' => $this->sericeId]));

			}

			// Update the last active platform
			$this->user->lastActivePlatform = $this->service;
			$this->user->save();


			$message = new Message(['message' => trans('messages.new_user_registered')]);
			$this->user->messages->save($message);
		}

		public function askHelp(){

			if($this->user){

				$actualState = $this->user->state_id;
				$messageId = "";

				switch ($actualState) {
					
					default:
						$messageId = "messages.no_help_available";
						break;
				}

				$message = new Message(['message' => trans($messageId)]);
				$this->user->messages->save($message);

			} else {

				// User needs to register
				$message = new Message(['message' => trans('messages.user_not_registered')]);
				$this->user->messages->save($message);
			}

		}
	}