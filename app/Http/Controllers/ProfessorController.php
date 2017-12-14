<?php

namespace App\Http\Controllers;

use App\Professor;
use App\SchoolView;
use App\User;
use App\ProfessorSchool;
use App\ProfessorView;
use Illuminate\Http\Request;
use Validator;

class ProfessorController extends Controller
{
    protected $professor;
    protected $schoolSview;
    protected $user;
    protected $professorSchool;
    protected $professorView;

    public function __construct(){
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'schools' ]  =   'active';
        $this->leftActiveMenu[ 'professor' ]  =   'active';

        $this->professor        =   new Professor;
        $this->schoolView       =   new SchoolView;
        $this->user             =   new User;
        $this->professorSchool  =   new ProfessorSchool;
        $this->professorView    =   new ProfessorView;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view( 'professor.index',[
            'menu'      =>  $this->leftActiveMenu,
            'professor' =>  $this->professorView,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'professor.add',[
            'menu'      =>  $this->leftActiveMenu,
            'schools'   =>  $this->schoolView->pluck('school_name','id_school')
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
            'area'          =>  'required',
            'cpf'           =>  'required',
            'school'        =>  'required',
            'email'         =>  'required|email',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $this->user->user_lvl   =   2;
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
            
            $this->professor->user_id       =   $this->user->id;
            $this->professor->name          =   $request->input( 'name' );
            $this->professor->middlename    =   $request->input( 'middlename' );
            $this->professor->lastname      =   $request->input( 'lastname' );
            $this->professor->zipcode       =   $request->input( 'zipcode' );
            $this->professor->neighborhood  =   $request->input( 'neighborhood' );
            $this->professor->state         =   $request->input( 'state' );
            $this->professor->city_id       =   $request->input( 'city' );
            $this->professor->areas         =   $request->input( 'area' );
            $this->professor->gender        =   $request->input( 'gender' );
            $this->professor->cpf           =   $request->input( 'cpf' );
            $this->professor->mobile        =   $request->input( 'mobile' );
            $this->professor->phone         =   $request->input( 'phone' );
            $this->professor->birthdate     =   date( 'Y-m-d',strtotime( $request->input( 'birthdate' ) ) );
            $this->professor->address       =   'não informado';

            if ( $this->professor->save() ){

                $this->professorSchool->professor_id        =   $this->professor->id;
                $this->professorSchool->professor_user_id   =   $this->user->id;
                $this->professorSchool->school_id           =   $request->input( 'school' );

                if ( $this->professorSchool->save() )
                    $save = true;

            }
            
        }

        
        if ( $save )    return redirect()->route( 'professors' )->with( 'AddMessage','Adicionado com sucesso' );
        else            return redirect()->route( 'professors' )->with( 'ErrorMessage','Ocorreu um erro ao adicionar' );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor){

        return view('professor.edit',[
            'menu'      =>  $this->leftActiveMenu,
            'professor' =>  $professor,
            'schools'   =>  $this->schoolView->pluck('school_name','id_school')
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor){

        $professor->name          =   $request->input( 'name' );
        $professor->middlename    =   $request->input( 'middlename' );
        $professor->lastname      =   $request->input( 'lastname' );
        $professor->zipcode       =   $request->input( 'zipcode' );
        $professor->neighborhood  =   $request->input( 'neighborhood' );
        $professor->state         =   $request->input( 'state' );
        $professor->city_id       =   $request->input( 'city' );
        $professor->areas         =   $request->input( 'area' );
        $professor->gender        =   $request->input( 'gender' );
        $professor->cpf           =   $request->input( 'cpf' );
        $professor->mobile        =   $request->input( 'mobile' );
        $professor->phone         =   $request->input( 'phone' );
        $professor->birthdate     =   date( 'Y-m-d',strtotime( $request->input( 'birthdate' ) ) );
        $professor->address       =   'não informado';

        if ( $professor->save() ) return redirect()->route( 'professors' )->with( 'AddMessage','Editado com sucesso' );
        else    return redirect()->route( 'professors' )->with( 'ErrorMessage','Ocorreu um erro ao editar' );
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        if ( $professor->delete() ) return redirect()->route( 'professors' )->with( 'ErrorMessage','Deletado com sucesso' );
        else    return redirect()->route( 'professors' )->with( 'ErrorMessage','Ocorreu um erro ao editar' );
    }
}
