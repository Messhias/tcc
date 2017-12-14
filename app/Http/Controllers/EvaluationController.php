<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\Student;
use App\StudentEvaluationDataView;
use Illuminate\Http\Request;
use DB;

class EvaluationController extends Controller
{

    protected $evaluation;
    protected $students;
    protected $studentEvaluationData;

    public function __construct(){
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'evaluation' ]      =   'active';

        $this->evaluation               = new Evaluation;
        $this->students                 = new Student;
        $this->studentEvaluationData    = new StudentEvaluationDataView;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(){

        // dd( $this->evaluation->groupBy('aluno_id')->get()[0]->students );
        
        return view( 'evaluation.index',[
            'menu'          =>  $this->leftActiveMenu,
            'evaluations'   =>  $this->evaluation->groupBy('aluno_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'evaluation.add',[
            'menu'      =>  $this->leftActiveMenu,
            'students'   =>  $this->students->pluck('name','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->student = Student::find( $request->input( 'student' ) );
        $this->studentEvaluationData = StudentEvaluationDataView::where([
            'user_id'           =>  $this->student->user_id,
            'course_id'         =>  $request->input( 'course' ),
            'discipline_id'     =>  $request->input( 'discipline' ),
        ])
        ->get();

        $this->evaluation->aluno_id         =   $this->student->id;
        $this->evaluation->aluno_user_id    =   $this->student->user_id;
        $this->evaluation->course_class_id  =   $this->studentEvaluationData[0]->course_class_id;
        $this->evaluation->first            =   $request->input( 'first' );
        $this->evaluation->second           =   $request->input( 'second' );
        $this->evaluation->third            =   $request->input( 'third' );
        $this->evaluation->others           =   json_encode( $request->input ( 'others' ) );

        
        if ( $this->evaluation->save() ) return redirect()->route('evaluation')->with('AddMessage','Adicionado com sucesso');
        else return redirect()->route('evaluation')->with('ErrorMessage','Ocorreu um erro ao adicionar');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation){

        $this->evaluation = $evaluation->where([
            'aluno_id'  =>  $evaluation->aluno_id
        ]);

        return view( 'evaluation.show', [
            'menu'          =>  $this->leftActiveMenu,
            'evaluation'    =>  $this->evaluation,
            'others'        =>  json_decode($this->evaluation->get()[0]->others)
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation){

        $courses = array();
        
        $this->evaluation = $evaluation->where([
            'aluno_id'  =>  $evaluation->aluno_id
        ]);

        // getting courses
        foreach($this->evaluation->get() as $eval => $evaluations){
            $courses[] = array(
                'name'  => $evaluations->coursesClass->course->name, 
                'id'    => $evaluations->coursesClass->course->id
            );
        }            

        // removing duplicates
        $courses = array_map( "unserialize" , array_unique( array_map( "serialize", $courses ) ) );
        
        // dd($this->evaluation->get()[1]->coursesClass->discipline);
        
        return view( 'evaluation.edit',[
            'menu'          =>  $this->leftActiveMenu,
            'evaluation'    =>  $this->evaluation,
            'courses'       =>  $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation){
        $this->student = Student::find( $request->input( 'student' ) );

        $evaluation->first            =   $request->input( 'first' );
        $evaluation->second           =   $request->input( 'second' );
        $evaluation->third            =   $request->input( 'third' );
        $evaluation->others           =   json_encode( $request->input ( 'others' ) );

        
        if ( $evaluation->save() ) return redirect()->route('evaluation')->with('AddMessage','Editar com sucesso');
        else return redirect()->route('evaluation')->with('ErrorMessage','Ocorreu um erro ao editar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation){
        if ( $evaluation->delete() ) return redirect()->route('evaluation')->with('AddMessage','Avaliação(ões) deletadas com sucesso');
        else return redirect()->route('evaluation')->with('ErrorMessage','Ocorreu um erro ao deletar');
    }
}
