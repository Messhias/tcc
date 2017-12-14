<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\SchoolView;
use \App\Schools;
use Validator;

class SchoolController extends Controller
{
    protected $school;
    protected $schoolView;

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct(){
        
        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';

        $this->leftActiveMenu[ 'schools' ]           =   'active';
        $this->leftActiveMenu[ 'schoolsUnits' ]     =   'active';

        $this->school       = new Schools();
        $this->schoolView   = new SchoolView();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'school.index', [
                'menu'      =>  $this->leftActiveMenu,
                'schools'   =>  $this->schoolView,
            ] 
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('school.add',[
            'menu'  =>  $this->leftActiveMenu
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
        $validator = Validator::make( $request->all(), [
            'name'  =>  'required|unique:school',
            'cnpj'  =>  'required|unique:school'
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $this->school->name   =     $request->input( 'name' );
        $this->school->cnpj   =     $request->input( 'cnpj' );

        if ( $this->school->save() )
            return redirect()
                ->route( 'schools' )
                    ->with( 'AddMessage', 'Unidade de ensino adicionada com sucesso');
        else
            return redirect()
            ->route( 'schools' )
                ->with( 'ErrorMessage', 'Ocorreu um erro ao adicionar a unidade de ensino');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->schoolView = $this->schoolView->where([
            'id_school' =>  $id
        ])->firstOrFail();


        return view( 'school.edit',[
            'menu'      =>  $this->leftActiveMenu,
            'school'    =>  $this->schoolView,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->school   =   $this->school->find($id);

        $this->school->name =   $request->input( 'name' );
        $this->school->cnpj =   $request->input( 'cnpj' );

        if ( $this->school->save() )
            return redirect()
            ->route( 'schools' )
                ->with( 'AddMessage', 'Unidade de ensino editada com sucesso');
        else
            return redirect()
            ->route( 'schools' )
                ->with( 'ErrorMessage', 'Ocorreu um erro ao editar a unidade de ensino');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->school   =   $this->school->find($id);

        
        if ( $this->school->delete() )
            return redirect()
                ->route( 'schools' )
                    ->with( 'ErrorMessage', 'Unidade de ensino deletada com sucesso');
        else
            return redirect()
                ->route( 'schools' )
                    ->with( 'ErrorMessage', 'Ocorreu um erro ao deletar a unidade de ensino');
    }
}
