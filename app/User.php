<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'lastActivePlatform'
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
}
