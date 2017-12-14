<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesSchools extends Model
{
    protected $table = 'course_school';

    public function schools(){
        return $this->belongsTo('App\Schools','school_id','id');
    }

    public function courses(){
        return $this->belongsTo('App\Courses','course_id','id');
    }
}
