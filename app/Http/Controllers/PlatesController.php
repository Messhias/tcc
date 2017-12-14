<?php

namespace App\Http\Controllers;

use App\Plates;
use App\ClassroomView;
use App\StudentView;
use Validator;
use Illuminate\Http\Request;

class PlatesController extends Controller
{

    protected $plates;
    protected $classroomView;
    protected $StudentView;
    
    public function __construct(){
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'plates' ]      =   'active';

        $this->plates           = new Plates;
        $this->classroomView    = new ClassroomView;
        $this->StudentView      = new StudentView;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('plates.index',[
            'menu'      =>  $this->leftActiveMenu, 
            'plates'    =>   $this->plates->where('name','!=','null')->groupBy('discipline_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'plates.add',[
            'menu'      =>  $this->leftActiveMenu,
            'classroom' =>  $this->classroomView->groupBy('classroom')->pluck('classroom','id'),
            'students'  =>  $this->StudentView,
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $save = false;        

        $validator = Validator::make( $request->all(), [
            'classroom'     =>  'required',
            'students'      =>  'required',
            'start'         =>  'required',
            'end'           =>  'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $newPlate = new Plates;

        $this->plates = $this->plates->find($request->input('classroom'));

        $newPlate->class_id         = $this->plates->class_id;
        $newPlate->discipline_id    = $this->plates->discipline_id;
        $newPlate->professor_id     = $this->plates->professor_id;
        $newPlate->course_id        = $this->plates->course_id;
        $newPlate->classroom        = $this->plates->classroom;  
        $newPlate->name             = $this->plates->classes[0]->name . ' - Disciplina ' . $this->plates->disciplines[0]->name;

        if( $this->plates->delete() ){

            unset( $this->plates );
            
            foreach ($request->input( 'students' ) as $key => $student) {
                # code...
                $addPlate =  new Plates();
                
                $addPlate->class_id         = $newPlate->class_id;
                $addPlate->discipline_id    = $newPlate->discipline_id;
                $addPlate->course_id        = $newPlate->course_id;
                $addPlate->professor_id     = $newPlate->professor_id;
                $addPlate->aluno_id         = $student;
                $addPlate->hr_start         = $request->input( 'start' );
                $addPlate->hr_end           = $request->input( 'end' );
                $addPlate->name             = $newPlate->name;

                if ($addPlate->save() ){
                    $save = true;
                    unset( $addPlate );
                }else $save = false;
            }
        }

        if ( $save ) return redirect()->route('plates')->with('AddMessage','Turma criada com sucesso');
        else return redirect()->route('plates')->with('ErrorMessage','Ocorreu um erro ao criar a turma');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plates  $plates
     * @return \Illuminate\Http\Response
     */
    public function show(Plates $plates){
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plates  $plates
     * @return \Illuminate\Http\Response
     */
    public function edit(Plates $plates){
        return view( 'plates.edit' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plates  $plates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plates $plates){
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plates  $plates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plates $plates){
        if ( $plates->where('class_id','=',$plates->class_id)->delete() )    return redirect()->route( 'plates' )->with( 'ErrorMessage','Deletado com sucesso' );
        else    return redirect()->route( 'plates' )->with( 'ErrorMessage','Ocorreu um erro ao deletar' );
    }

    public function student(Plates $plates){
        $students = new Plates;

        $students  = $students->where("class_id","=",$plates->class_id)->get();
        dd($students[0]->students[0]->id);        
    }
}
