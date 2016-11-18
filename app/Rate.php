<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //

    protected $fillable = ['translation_answer_id', 'user_id', 'value'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function translationAnswer()
    {
    	return $this->belongsTo('App\TranslationAnswer');
    }
}
