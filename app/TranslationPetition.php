<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationPetition extends Model
{
    protected $fillable = ['user_id', 'translation_request_id', 'closed', 'sent']

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

    public function translationAnswer()
    {
        return $this->hasOne('App\TranslationAnswer');
    }
}
