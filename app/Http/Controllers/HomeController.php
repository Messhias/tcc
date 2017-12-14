<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\ProfessorView;
use \App\SchoolView;
use \App\CoursesView;
use \App\StudentView;

class HomeController extends Controller
{

    protected $professorView;
    protected $schoolView;
    protected $courseView;
    protected $studentView;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->professorView    =   new ProfessorView;
        $this->schoolView       =   new SchoolView;
        $this->courseView       =   new CoursesView;
        $this->studentView      =   new StudentView;    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',[
                'menu'          =>  $this->leftActiveMenu,
                'professor'     =>  $this->professorView,
                'school'        =>  $this->schoolView,
                'course'        =>  $this->courseView,
                'students'      =>  $this->studentView
            ]
        );
    }
}
