<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{
    protected $table = "aluno";

    
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
}
