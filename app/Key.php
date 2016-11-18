<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $fillable = ['user_id', 'name', 'key'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
