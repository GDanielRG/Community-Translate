<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    // Languge class

	protected $fillable = ['name', 'code', 'system'];

    public function targetTranslationRequest()
    {
    	return $this->hasMany('App\TranslationRequest', 'target_language_id', 'id');
    }

    public function sourceTranslationRequest()
    {
    	return $this->hasMany('App\TranslationRequest', 'source_language_id', 'id');
    }

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
