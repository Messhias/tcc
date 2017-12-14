<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route( 'home' );
});

Auth::routes();


// -----------------------=============================--------------//

// AJAX ROUTES

Route::get( 'disciplineDataByCourseID', 'AjaxController@disciplineDataByCourseID' )->name( 'disciplineDataByCourseID' );
Route::get( 'getAlunoData/{aluno}', "AjaxController@getAlunoData")->name( 'getAlunoData' );
Route::get( 'getEvaluationsByDiscipline/{id}', 'AjaxController@getEvaluationsByDiscipline' )->name( 'getEvaluationsByDiscipline' );
Route::get( 'getOthersEvaluationsByDiscipline/{id}', 'AjaxController@getOthersEvaluationsByDiscipline' )->name( 'getOthersEvaluationsByDiscipline' );
Route::get( 'getFoulsById/{id}', 'AjaxController@getFoulsById' )->name( 'getFoulsById' );
// -----------------------=============================--------------//


Route::get('/home', 'HomeController@index')->name('home');


// School routes
// GET ROUTES
Route::get( 'schools' , 'SchoolController@index' )->name( 'schools' );
Route::get( 'add-school-unit', 'SchoolController@create')->name( 'add-school-unit');
Route::get( 'edit-school-unit/{id}', 'SchoolController@edit' )->name( 'edit-school-unit' );
// end

// POST ROUTES
Route::post( 'add-school-unit', 'SchoolController@store' )->name( 'add-school-unit' );
// end

// delete routes
Route::delete( 'delete-school-unit/{id}', 'SchoolController@destroy' )->name( 'delete-school-unit/' );
// end

// PUT routes
Route::put( 'edit-school-unit/{id}', 'SchoolController@update')->name( 'edit-school-unit/' );
// end

// -----------------------=============================--------------//

// courses routes
// GET routes
Route::get( 'courses', 'CoursesController@index' )->name( 'courses' );
Route::get( 'add-course', 'CoursesController@create' )->name( 'add-course' );
Route::get( 'edit-course/{id}','CoursesController@edit')->name( 'edit-course/');
// end

// POST routes
Route::post( 'add-course', 'CoursesController@store' )->name( 'add-course' );
// end

// PUT ROUTES
Route::put( 'edit-course/{id}','CoursesController@update')->name( 'edit-course' );
// 

// Delete routes
Route::delete ('delete-course/{course_id}/{school_id}','CoursesController@destroy' )->name('delete-course/');
// end

// -----------------------=============================--------------//

// PROFESSOR ROUTES

// GET ROUTES
Route::get( 'professors', 'ProfessorController@index' )->name( 'professors' );
Route::get( 'add-professor', 'ProfessorController@create' )->name( 'add-professor' );
Route::get( 'edit-professor/{professor}', 'ProfessorController@edit' )->name( 'edit-professor' );
// 

// ROUTE POST
Route::post( 'add-professor', 'ProfessorController@store' )->name( 'add-professor' );
// end

// ROUTE DELETE
Route::delete( 'delete-professor/{professor}', 'ProfessorController@destroy' )->name('delete-professor');
// END

// ROUTE PUT
Route::put( 'edit-professor/{professor}', 'ProfessorController@update' )->name( 'edit-professor/' );

// -----------------------=============================--------------//

// DISCIPLINES ROUTES

// GET ROUTES
Route::get( 'disciplines', 'DisciplinesController@index' )->name( 'disciplines' );
Route::get( 'add-discipline', 'DisciplinesController@create' )->name( 'add-discipline' );
Route::get( 'edit-discipline/{disciplines}', 'DisciplinesController@edit' )->name( 'edit-discipline' );
// POST ROUTES
Route::post( 'add-discipline', "DisciplinesController@store" )->name( 'add-discipline' );

// DELETE ROUTES
Route::delete( 'delete-discipline/{disciplines}', 'DisciplinesController@destroy')->name( 'delete-discipline' );

// PUT ROUTES
Route::put( 'edit-discipline/{disciplines}', 'DisciplinesController@update' )->name( 'edit-discipline' );

// -----------------------=============================--------------//

// students ROUTES

// GET ROUTES
Route::get( 'students', 'StudentController@index' )->name( 'students' );
Route::get( 'add-student', 'StudentController@create' )->name( 'add-student' );
Route::get( 'edit-student/{student}', 'StudentController@edit' )->name( 'edit-student' );
// POST ROUTES
Route::post( 'add-student', "StudentController@store" )->name( 'add-student' );

// DELETE ROUTES
Route::delete( 'delete-student/{student}', 'StudentController@destroy')->name( 'delete-student' );

// PUT ROUTES
Route::put( 'edit-student/{student}', 'StudentController@update' )->name( 'edit-student' );

// -----------------------=============================--------------//

// ClassesController ROUTES

// GET ROUTES
Route::get( 'class', 'ClassesController@index' )->name( 'class' );
Route::get( 'add-class', 'ClassesController@create' )->name( 'add-class' );
Route::get( 'edit-class/{classes}', 'ClassesController@edit' )->name( 'edit-class' );
// POST ROUTES
Route::post( 'add-class', "ClassesController@store" )->name( 'add-class' );

// DELETE ROUTES
Route::delete( 'delete-class/{classes}', 'ClassesController@destroy')->name( 'delete-class' );

// PUT ROUTES
Route::put( 'edit-class/{classes}', 'ClassesController@update' )->name( 'edit-class' );

// -----------------------=============================--------------//

// ClassRoomController ROUTES

// GET ROUTES
Route::get( 'classroom', 'ClassRoomController@index' )->name( 'classroom' );
Route::get( 'add-classroom', 'ClassRoomController@create' )->name( 'add-classroom' );
Route::get( 'edit-classroom/{classRoom}', 'ClassRoomController@edit' )->name( 'edit-classroom' );
// POST ROUTES
Route::post( 'add-classroom', "ClassRoomController@store" )->name( 'add-classroom' );

// DELETE ROUTES
Route::delete( 'delete-classroom/{classRoom}', 'ClassRoomController@destroy')->name( 'delete-classroom' );

// PUT ROUTES
Route::put( 'edit-classroom/{classRoom}', 'ClassRoomController@update' )->name( 'edit-classroom' );

// -----------------------=============================--------------//

// PlatesController ROUTES

// GET ROUTES
Route::get( 'plates', 'PlatesController@index' )->name( 'plates' );
Route::get( 'add-plates', 'PlatesController@create' )->name( 'add-plates' );
Route::get( 'edit-plates/{plates}', 'PlatesController@student' )->name( 'edit-plates' );
Route::get( 'show-students/{plates]',"PlatesController@student" )->name( 'show-students' );

// POST ROUTES
Route::post( 'add-plates', "PlatesController@store" )->name( 'add-plates' );

// DELETE ROUTES
Route::delete( 'delete-plates/{plates}', 'PlatesController@destroy')->name( 'delete-plates' );

// PUT ROUTES
Route::put( 'edit-plates/{plates}', 'PlatesController@update' )->name( 'edit-plates' );

// -----------------------=============================--------------//

// EvaluationController ROUTES

// GET ROUTES
Route::get( 'evaluation', 'EvaluationController@index' )->name( 'evaluation' );
Route::get( 'add-evaluation', 'EvaluationController@create' )->name( 'add-evaluation' );
Route::get( 'edit-evaluation/{evaluation}', 'EvaluationController@edit' )->name( 'edit-evaluation' );
Route::get( 'show-evaluation/{evaluation}',"EvaluationController@show" )->name( 'show-evaluation' );

// POST ROUTES
Route::post( 'add-evaluation', "EvaluationController@store" )->name( 'add-evaluation' );

// DELETE ROUTES
Route::delete( 'delete-evaluation/{evaluation}', 'EvaluationController@destroy')->name( 'delete-evaluation' );

// PUT ROUTES
Route::put( 'edit-evaluation/{evaluation}', 'EvaluationController@update' )->name( 'edit-evaluation' );

// -----------------------=============================--------------//



// FoulController ROUTES

// GET ROUTES
Route::get( 'foul', 'FoulController@index' )->name( 'foul' );
Route::get( 'add-foul', 'FoulController@create' )->name( 'add-foul' );
Route::get( 'edit-foul/{foul}', 'FoulController@edit' )->name( 'edit-foul' );
Route::get( 'show-foul/{foul}',"FoulController@show" )->name( 'show-foul' );

// POST ROUTES
Route::post( 'add-foul', "FoulController@store" )->name( 'add-foul' );

// DELETE ROUTES
Route::delete( 'delete-foul/{foul}', 'FoulController@destroy')->name( 'delete-foul' );

// PUT ROUTES
Route::put( 'edit-foul/{foul}', 'FoulController@update' )->name( 'edit-foul' );

// -----------------------=============================--------------//
