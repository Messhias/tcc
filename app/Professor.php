<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professor';

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
