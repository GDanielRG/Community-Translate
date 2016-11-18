<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslationPetition extends Model
{
    //

    public function translationRequest()
    {
    	return $this->belongsTo('App\TranslationRequest');
    }
}
