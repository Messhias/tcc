<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Courses;
use \App\CoursesView;
use \App\CoursesSchools;
use \App\SchoolView;
use Validator;

class CoursesController extends Controller
{

    protected $courses;
    protected $coursesView;
    protected $coursesSchools;
    protected $schoolView;
    
    public function __construct(){

        foreach ($this->leftActiveMenu as $key => $value) $this->leftActiveMenu[$key] = '';
        $this->leftActiveMenu[ 'schools' ]  =   'active';
        $this->leftActiveMenu[ 'courses' ]  =   'active';

        $this->courses          =   new Courses;
        $this->coursesView      =   new CoursesView;
        $this->coursesSchools   =   new CoursesSchools;
        $this->schoolView       =   new SchoolView;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view ( 'course.index',[
            'menu'      =>  $this->leftActiveMenu,
            'courses'   =>  $this->coursesView,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('course.add',[
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
        
        $save = false;
        
        $validator = Validator::make( $request->all(), [
            'name'      =>  'required',
            'schools'   =>  'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }

        foreach($request->input( 'schools' ) as $key => $value){

            if( !empty( $value ) ){
                $this->course = new Courses;
                $this->course->name = $request->input( 'name' );

                if( $this->course->save( ) ){
                    $this->coursesSchools = new CoursesSchools;

                    $this->coursesSchools->course_id    =   $this->course->id;
                    $this->coursesSchools->school_id    =   $value;
                    
                    if( $this->coursesSchools->save() )
                        $save   =   true;
                    else
                        $save   =   false;
                    
                }else
                    $save = false;
            }else
                $save = false;
        }

        if ( $save )
            return redirect()
                ->route('courses')
                    ->with('AddMessage','Adicionado com sucesso');
        else
            return redirect()
            ->route('courses')
                ->with('ErrorMessage','Ocorreu um erro ao adicionar');
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
    public function edit($id){
        
        $this->coursesSchools = $this->coursesSchools->find($id);

        // dd($this->coursesSchools->schools);
        
        return view('course.edit',[
            'menu'      =>  $this->leftActiveMenu,
            'schools'   =>  $this->schoolView->pluck('school_name','id_school'),
            'data'      =>  $this->coursesSchools
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
        $save = false;
        
        $validator = Validator::make( $request->all(), [
            'name'      =>  'required',
            'schools'   =>  'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors( $validator )
                ->withInput();
        }
        $this->coursesSchools   = $this->coursesSchools->find($id);
        $this->courses          = $this->courses->find($this->coursesSchools->courses->id);
        foreach($request->input( 'schools' ) as $key => $value){

            if( !empty( $value ) ){
                $this->courses->name = $request->input( 'name' );

                if( $this->courses->save( ) ){

                    $this->coursesSchools->course_id    =   $this->courses->id;
                    $this->coursesSchools->school_id    =   $value;
                    
                    if( $this->coursesSchools->save() )
                        $save   =   true;
                    else
                        $save   =   false;
                    
                }else
                    $save = false;
            }else
                $save = false;
        }

        if ( $save )
            return redirect()
                ->route('courses')
                    ->with('AddMessage','Editado com sucesso');
        else
            return redirect()
            ->route('courses')
                ->with('ErrorMessage','Ocorreu um erro ao editar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$school_id)
    {
        $this->coursesSchools = $this->coursesSchools->where([
            'course_id' =>  $id,
            'school_id' =>  $school_id,
        ]);

        if( $this->coursesSchools->delete() ){

            return redirect()
            ->route('courses')
                ->with('ErrorMessage','Deletado com sucesso');
        }else{

            return redirect()
            ->route('courses')
                ->with('ErrorMessage','Ocorreu um erro ao editar');
        }
    }
}
