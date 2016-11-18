<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationPetition extends Model
{
    protected $fillable = ['user_id', 'language_id', 'translation_request_id', 'closed', 'sent']

    public function translationRequest()
    {
    	return $this->belongsTo('App\TranslationRequest');
    }

    public function creator()
    {
        return $this->belongsTo('App\TranslationRequest')->first()->user;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function translationAnswers()
    {
        return $this->hasMany('App\TranslationAnswer');
    }

    public function messages()
	{
		return $this->morphMany('App\Message', 'messageable');
	}

    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
