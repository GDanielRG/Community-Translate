<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Language;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'lastActivePlatform', 'score', 'state_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function rates()
    {
        return $this->hasMany('App\Rate');
    }

    public function translationPetitions()
    {
        return $this->hasMany('App\TranslationPetition');
    }

    public function translationRequests()
    {
        return $this->hasMany('App\TranslationRequest');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function languages()
	{
		return $this->belongsToMany('App\Language');
	}

    public function knows($language)
    {
        return Language::where('name', $language)->orWhere('code', $language)->first();
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function keys()
    {
        return $this->hasMany('App\Key');
    }

    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
