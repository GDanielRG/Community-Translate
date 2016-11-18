<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationRequest extends Model
{
    protected $fillable = ['user_id', 'language_id', 'text', 'closed', 'last_petition'];

    protected $dates = ['last_petition'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    public function translationAnswers()
    {
        return $this->hasManyThrough('App\TranslationAnswer', 'App\TranslationPetition');
    }

    public function translationPetitions()
    {
        return $this->hasMany('App\TranslationPetition');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\TranslationPetition');
    }

    public function messages()
	{
		return $this->morphMany('App\Message', 'messageable');
	}
}
