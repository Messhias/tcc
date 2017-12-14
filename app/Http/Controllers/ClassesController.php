<?php

namespace App\Http\Controllers;

use App\Classes;
use App\ClassView;
use Illuminate\Http\Request;
use Validator;

class ClassesController extends Controller
{

    protected $classes;
    protected $classView;

    public function __construct(){
        
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'schools' ]  =   'active';
        $this->leftActiveMenu[ 'classes' ]  =   'active';

        $this->classes      = new Classes();
        $this->classView    = new ClassView();
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view( 'classes.index',[
            'menu'      =>  $this->leftActiveMenu,
            'classes'   =>  $this->classView
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'classes.add',[
            'menu'      =>  $this->leftActiveMenu,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make( $request->all(), [
            'name'      =>  'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $this->classes->name = $request->input( 'name' );
        
        if ( $this->classes->save() ) return redirect()->route('class')->with('AddMessage','Adicionado com sucesso');
        else return redirect()->route('class')->with('ErrorMessage','Ocorreu um erro ao adicionar');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes){
        return view( 'classes.edit',[
            'menu'  =>  $this->leftActiveMenu,
            'class' =>  $classes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {

        $classes->name = $request->input( 'name' );

        if ( $classes->save() ) return redirect()->route('class')->with('AddMessage','Editado com sucesso');
        else return redirect()->route('class')->with('ErrorMessage','Ocorreu um erro ao editar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes){
        if ( $classes->save() ) return redirect()->route('class')->with('ErrorMessage','Deletado com sucesso');
        else return redirect()->route('class')->with('ErrorMessage','Ocorreu um erro ao deletar');
    }
}
