<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plates extends Model
{
    protected $table = 'course_class';

    public function students(){
        return $this->hasMany('App\Student', 'id', 'aluno_id');
    }

    public function classes(){
        return $this->hasMany('App\Classes', 'id', 'class_id');
    }

    public function disciplines(){
        return $this->hasMany('App\Disciplines', 'id', 'discipline_id');
    }

    public function professors(){
        return $this->hasMany('App\Professor', 'id', 'professor_id');
    }
}
