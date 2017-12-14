<?php

namespace App\Http\Controllers;

use App\Disciplines;
use App\DisciplineView;
use App\CoursesView;
use Validator;
use DB;
use Illuminate\Http\Request;

class DisciplinesController extends Controller
{

    protected $disciplineView;
    protected $discipline;

    public function __construct(){
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'schools' ]      =   'active';
        $this->leftActiveMenu[ 'discipline' ]   =   'active';

        $this->disciplineView   =   new DisciplineView;
        $this->discipline       =   new Disciplines;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view( 'discipline.index',[
            'menu'          =>  $this->leftActiveMenu,
            'disciplines'    => $this->disciplineView,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'discipline.add',[
            'menu'      =>  $this->leftActiveMenu,
            'courses'   => \App\CoursesView::select(
                DB::raw("CONCAT(course_name,' - ',school_name) AS name"),'course_id')
                ->pluck('name', 'course_id')
        ]);
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
            'name'          =>  'required|unique:discipline',
            'courses'       =>  'required',
        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        foreach($request->input( 'courses' ) as $key => $value){

            if ( $value != null and !empty( $value ) ){
                
                $this->discipline = new Disciplines;
    
                $this->discipline->name         =   $request->input( 'name' );
                $this->discipline->course_id    =   $value;
                $this->discipline->description  =   $request->input( 'description' );
    
                if( $this->discipline->save() )
                    $save = true;
                else
                    $save = false;
            }            
        }

        unset( $this->discipline );

        if ( $save )    return redirect()->route( 'disciplines' )->with( 'AddMessage','Adicionada com sucesso' );
        else    return redirect()->route( 'disciplines' )->with( 'ErrorMessage','Ocorreu um erro ao adicionar' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplines $disciplines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplines $disciplines){

        return view ( 'discipline.edit',[
            'menu'          =>  $this->leftActiveMenu,
            'discipline'    =>  $disciplines,
            'courses'       => \App\CoursesView::select(
                DB::raw("CONCAT(course_name,' - ',school_name) AS name"),'course_id')
                ->pluck('name', 'course_id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disciplines $disciplines){

        $disciplines->name          =   $request->input( 'name' );
        $disciplines->description   =   $request->input( 'description' );
        $disciplines->course_id     =   $request->input( 'courses' );

        if ( $disciplines->save() )    return redirect()->route( 'disciplines' )->with( 'AddMessage','Editada com sucesso' );
        else    return redirect()->route( 'disciplines' )->with( 'ErrorMessage','Ocorreu um erro ao editar' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disciplines $disciplines){

        if ( $disciplines->delete() )    return redirect()->route( 'disciplines' )->with( 'ErrorMessage','Deletada com sucesso' );
        else    return redirect()->route( 'disciplines' )->with( 'ErrorMessage','Ocorreu um erro ao deletar' );
    }
}
