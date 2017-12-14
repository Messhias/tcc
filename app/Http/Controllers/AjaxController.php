<?php

namespace App\Http\Controllers;

use App\StudentEvaluationDataView;
use App\DisciplineView;
use App\Evaluation;
use App\Foul;
use Illuminate\Http\Request;

class AjaxController extends Controller{

    protected $StudentEvaluationDataView;

    public function __construct(){
        $this->StudentEvaluationDataView;
    }

    public function getAlunoData(StudentEvaluationDataView $aluno){

        return response()->json([
            'student'       => $aluno,
            'courses'       => $aluno->courses,
            'disciplines'   => $aluno->disciplines,
            'courseClass'   => $aluno->courseClass,
            'rows'      => count( $aluno ),
        ]);
        
    }

    public function disciplineDataByCourseID(Request $request){
        return response()->json([
            'discipline'    =>  \App\DisciplineView::where('course_id','=',84)->get(),
        ]);
    }

    public function getEvaluationsByDiscipline(Evaluation $id){ return response()->json([$id]); }

    public function getOthersEvaluationsByDiscipline(Evaluation $id){ return response()->json( json_decode( $id->others ) ); }
    
    public function getFoulsById(Foul $id){ return response()->json([$id]); }
}
