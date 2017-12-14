<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'course';

    
    public function coursesSchool(){
        return $this->belongsTo('App\CoursesSchools','id','course_id');
    }
}
