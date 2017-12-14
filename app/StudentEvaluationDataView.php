<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEvaluationDataView extends Model{
    protected $table = 'student_evaluation_data';

    public function courseClass(){
        return $this->belongsTo('App\ClassRoom','course_class_id','id');
    }

    public function disciplines(){
        return $this->belongsTo('App\Disciplines','discipline_id','id');
    }

    public function courses(){
        return $this->belongsTo('App\Courses','course_id','id');
    }
}
