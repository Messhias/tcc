<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model{
    protected $table = 'evaluation';

    public function students(){
        return $this->hasMany('App\Student', 'id', 'aluno_id');
    }

    public function coursesClass(){
        return $this->belongsTo('App\ClassRoom','course_class_id','id');
    }

}
