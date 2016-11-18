<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationAnswer extends Model
{

	protected $fillable= ['translation', 'translation_petition_id'];

	public function translationPetition()
	{
		return $this->belongsTo('App\TranslationPetition');
	}

	public function rates()
	{
		return $this->hasMany('App\Rate');
	}

	public function messages()
	{
		return $this->morphMany('App\Message', 'messageable');
	}

}
