<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\ClassroomView;
use App\ProfessorView;
use App\SchoolView;
use App\DisciplineView;
use App\ClassView;
use App\CoursesView;
use Illuminate\Http\Request;
use Validator;

class ClassRoomController extends Controller
{

    protected $classroom;
    protected $ClassroomView;
    protected $professorView;
    protected $schoolView;
    protected $ClassView;
    protected $CoursesView;

    public function __construct(){
        
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'schools' ]      =   'active';
        $this->leftActiveMenu[ 'classroom' ]    =   'active';

        $this->classes          = new ClassRoom();
        $this->ClassroomView    = new ClassroomView();
        $this->professorView    = new ProfessorView();
        $this->schoolView       = new SchoolView();
        $this->disciplineView   = new DisciplineView();
        $this->ClassView        = new ClassView();
        $this->CoursesView      = new CoursesView();
        $this->classroom        = new ClassRoom();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view( 'classroom.index',[
            'menu'      => $this->leftActiveMenu,
            'classes'   => $this->ClassroomView::groupBy('discipline_id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'classroom.add',[
            'menu'          =>  $this->leftActiveMenu,
            'professor'     =>  $this->professorView->pluck( 'professor_name', 'professor_id' ),
            'school'        =>  $this->schoolView->pluck( 'school_name', 'id_school' ),
            'discipline'    =>  $this->disciplineView->pluck( 'discipline_name','discipline_id' ),
            'class'         =>  $this->ClassView->pluck( 'name' , 'id' ),
            'course'        =>  $this->CoursesView->pluck( 'course_name', 'course_id' )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->classroom->name          =   $request->input( 'name' );
        $this->classroom->class_id      =   $request->input( 'class' );
        $this->classroom->course_id     =   $request->input( 'course' );
        $this->classroom->discipline_id =   $request->input( 'discipline' );
        $this->classroom->professor_id  =   $request->input( 'professor' );

        if ( $this->classroom->save() )    return redirect()->route( 'classroom' )->with( 'AddMessage','Adicionada com sucesso' );
        else    return redirect()->route( 'classroom' )->with( 'ErrorMessage','Ocorreu um erro ao adicionar' );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom){
        return view( 'classroom.edit',[
            'menu'          =>  $this->leftActiveMenu,
            'classroom'     =>  $classRoom->get()[0],
            'professor'     =>  $this->professorView->pluck( 'professor_name', 'professor_id' ),
            'school'        =>  $this->schoolView->pluck( 'school_name', 'id_school' ),
            'discipline'    =>  $this->disciplineView->pluck( 'discipline_name','discipline_id' ),
            'class'         =>  $this->ClassView->pluck( 'name' , 'id' ),
            'course'        =>  $this->CoursesView->pluck( 'course_name', 'course_id' )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $classRoom)
    {

        $classRoom->name          =   $request->input( 'name' );
        $classRoom->class_id      =   $request->input( 'class' );
        $classRoom->course_id     =   $request->input( 'course' );
        $classRoom->discipline_id =   $request->input( 'discipline' );
        $classRoom->professor_id  =   $request->input( 'professor' );

        if ( $classRoom->save() )    return redirect()->route( 'classroom' )->with( 'AddMessage','Edidata com sucesso' );
        else    return redirect()->route( 'classroom' )->with( 'ErrorMessage','Ocorreu um erro ao editar' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $classRoom)
    {
        if ( $classRoom->delete() )    return redirect()->route( 'classroom' )->with( 'AddMessage','Edidata com sucesso' );
        else    return redirect()->route( 'classroom' )->with( 'ErrorMessage','Ocorreu um erro ao editar' );
    }
}
