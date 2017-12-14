<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model{
    protected $table = 'course_class';

    
    public function class(){
        return $this->belongsTo('App\Classes','class_id','id');
    }

    public function discipline(){
        return $this->belongsTo('App\Disciplines','discipline_id','id');
    }

    public function course(){
        return $this->belongsTo('App\Courses','course_id','id');
    }

    public function professor(){
        return $this->belongsTo('App\Professor','professor_id','id');
    }
}
