<?php

namespace App\Http\Controllers;

use App\Foul;
use App\Student;
use App\StudentEvaluationDataView;
use Illuminate\Http\Request;

class FoulController extends Controller
{
    protected $foul;
    protected $students;
    protected $studentEvaluationData;

    public function __construct(){

        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'fouls' ]  =   'active';

        $this->foul                     = new Foul;
        $this->students                 = new Student;
        $this->studentEvaluationData    = new StudentEvaluationDataView;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view( 'fouls.index',[
            'menu'  =>  $this->leftActiveMenu,
            'fouls' =>  $this->foul->groupBy('aluno_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'fouls.add',[
            'menu'      =>  $this->leftActiveMenu,
            'students'  =>  $this->students->pluck('name','id')
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
            'discipline_id'     =>  $request->input( 'discipline' ),
        ])
        ->get();

        $this->foul->aluno_id           =   $request->input( 'student' );
        $this->foul->users_id           =   $this->student->user_id;
        $this->foul->course_class_id    =   $this->studentEvaluationData[0]->course_class_id;
        $this->foul->quantity           =   $request->input( 'quantity' );

        if ( $this->foul->save() ) return redirect()->route('foul')->with('AddMessage','Adicionado com sucesso');
        else return redirect()->route('foul')->with('ErrorMessage','Ocorreu um erro ao adicionar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foul  $foul
     * @return \Illuminate\Http\Response
     */
    public function show(Foul $foul){
        return view( 'fouls.show',[
            'menu'      =>  $this->leftActiveMenu,
            'foul'  =>  $foul
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foul  $foul
     * @return \Illuminate\Http\Response
     */
    public function edit(Foul $foul){
        $courses = array();

        // getting courses
        foreach($foul->get() as $eval => $evaluations){
            $courses[] = array(
                'name'  => $evaluations->coursesClass->course->name, 
                'id'    => $evaluations->coursesClass->course->id
            );
        }            

        // removing duplicates
        $courses = array_map( "unserialize" , array_unique( array_map( "serialize", $courses ) ) );
        
        return view( 'fouls.edit',[
            'menu'      =>  $this->leftActiveMenu,
            'courses'   =>  $courses,
            'fouls'     =>  $this->foul
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Foul  $foul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foul $foul){

        $foul->quantity           =   $request->input( 'quantity' );

        if ( $foul->save() ) return redirect()->route('foul')->with('AddMessage','Editado com sucesso');
        else return redirect()->route('foul')->with('ErrorMessage','Ocorreu um erro ao editar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foul  $foul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foul $foul){
        if ( $foul->delete() ) return redirect()->route('foul')->with('ErrorMessage','Faltas deletadas com sucesso');
        else return redirect()->route('foul')->with('ErrorMessage','Ocorreu um erro ao deletar');
    }
}
