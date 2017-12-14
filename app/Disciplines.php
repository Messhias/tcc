<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplines extends Model{
    protected $table = 'discipline';


    public function course(){
        return $this->hasMany('App\Courses', 'id', 'course_id');
    }

    
}
