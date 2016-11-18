<?php

	namespace App\Http;

	use App\Key;

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
		
	}