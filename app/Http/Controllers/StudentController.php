<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentView;
use App\User;
use Validator;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $student;
    protected $studentView;

    public function __construct(){
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'schools' ]   =   'active';
        $this->leftActiveMenu[ 'student' ]   =   'active';

        $this->student      =   new Student;
        $this->studentView  =   new StudentView;
        $this->user         =   new User;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('student.index',[
            'menu'      =>  $this->leftActiveMenu,
            'students'   =>  $this->studentView,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('student.add',[
            'menu'  =>  $this->leftActiveMenu,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $save   =   true;

        $validator = Validator::make( $request->all(), [
            'name'          =>  'required',
            'middlename'    =>  'required',
            'lastname'      =>  'required',
            'birthdate'     =>  'required',
            'gender'        =>  'required',
            'zipcode'       =>  'required',
            'city'          =>  'required',
            'state'         =>  'required',
            'neighborhood'  =>  'required',
            'cpf'           =>  'required|unique:aluno',
            'email'         =>  'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $this->user->user_lvl   =   3;
        $this->user->username   =   $request->input( 'email' );
        $this->user->name       =   $request->input( 'name' );
        $this->user->middlename =   $request->input( 'middlename' );
        $this->user->lastname   =   $request->input( 'lastname' );
        $this->user->email      =   $request->input( 'email' );
        $this->user->access     =   json_encode([
            'course_class'  =>  [
                'view',
            ],
            'aluno'         =>  [
                'view'
            ],
            'discipline'    =>  [
                'view'
            ],
            'class'         =>  [
                'view',
            ],
            'course'        =>  [
                'view',
            ],
            'school'        =>  [
                'view'
            ]
        ]);
        $this->user->password   = bcrypt( str_replace( array( '-','.',' ' ),'',$request->input( 'cpf' ) ) );

        if ( $this->user->save() ){
            
            $this->student->user_id       =   $this->user->id;
            $this->student->name          =   $request->input( 'name' );
            $this->student->middlename    =   $request->input( 'middlename' );
            $this->student->lastname      =   $request->input( 'lastname' );
            $this->student->zipcode       =   $request->input( 'zipcode' );
            $this->student->neighborhood  =   $request->input( 'neighborhood' );
            $this->student->state         =   $request->input( 'state' );
            $this->student->city_id       =   $request->input( 'city' );
            $this->student->gender        =   $request->input( 'gender' );
            $this->student->cpf           =   $request->input( 'cpf' );
            $this->student->mobile        =   $request->input( 'mobile' );
            $this->student->phone         =   $request->input( 'phone' );
            $this->student->birthdate     =   date( 'Y-m-d',strtotime( $request->input( 'birthdate' ) ) );
            $this->student->address       =   'não informado';

            if ( $this->student->save() ){
                $save = true;
            }
        }

        if ( $save )    return redirect()->route( 'students' )->with( 'AddMessage','Adicionado com sucesso' );
        else            return redirect()->route( 'students' )->with( 'ErrorMessage','Ocorreu um erro ao adicionar' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student){
        return view( 'student.edit',[
            'menu'      =>  $this->leftActiveMenu,
            'student'   =>  $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student){

        $validator = Validator::make( $request->all(), [
            'name'          =>  'required',
            'middlename'    =>  'required',
            'lastname'      =>  'required',
            'birthdate'     =>  'required',
            'gender'        =>  'required',
            'zipcode'       =>  'required',
            'city'          =>  'required',
            'state'         =>  'required',
            'neighborhood'  =>  'required',
            'cpf'           =>  'required',
        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $student->name          =   $request->input( 'name' );
        $student->middlename    =   $request->input( 'middlename' );
        $student->lastname      =   $request->input( 'lastname' );
        $student->zipcode       =   $request->input( 'zipcode' );
        $student->neighborhood  =   $request->input( 'neighborhood' );
        $student->state         =   $request->input( 'state' );
        $student->city_id       =   $request->input( 'city' );
        $student->gender        =   $request->input( 'gender' );
        $student->cpf           =   $request->input( 'cpf' );
        $student->mobile        =   $request->input( 'mobile' );
        $student->phone         =   $request->input( 'phone' );
        $student->birthdate     =   date( 'Y-m-d',strtotime( $request->input( 'birthdate' ) ) );
        $student->address       =   'não informado';

        if ( $student->save() )    return redirect()->route( 'students' )->with( 'AddMessage','Adicionado com sucesso' );
        else            return redirect()->route( 'students' )->with( 'ErrorMessage','Ocorreu um erro ao adicionar' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student){
        if ( $student->delete() )    return redirect()->route( 'students' )->with( 'ErrorMessage','Deletado com sucesso' );
        else            return redirect()->route( 'students' )->with( 'ErrorMessage','Ocorreu um erro ao deletar' );
    }
}
