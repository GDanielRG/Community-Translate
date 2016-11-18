<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationRequest extends Model
{
    protected $fillable = ['user_id', 'target_language_id', 'source_language_id', 'text', 'closed', 'last_petition'];

    protected $dates = ['last_petition'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function targetLanguage()
    {
        return $this->belongsTo('App\Language', 'target_language_id');
    }

    public function sourceLanguage()
    {
        return $this->belongsTo('App\Language', 'source_language_id');
    }

    public function translationAnswers()
    {
        return $this->hasManyThrough('App\TranslationAnswer', 'App\TranslationPetition');
    }

    public function translationPetitions()
    {
        return $this->hasMany('App\TranslationPetition');
    }
}
