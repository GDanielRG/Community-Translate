<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    // Languge class

	protected $fillable = ['name', 'code', 'system'];


    public function translationRequests()
    {
    	return $this->hasMany('App\TranslationRequest');
    }

	public function translationPetitions()
    {
    	return $this->hasMany('App\TranslationPetition');
    }

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
