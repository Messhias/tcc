<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $leftActiveMenu = array(
        'home'          =>  'active',
        'schools'       =>  '',
        'schoolsUnits'  =>  '',
        'courses'       =>  '',
        'professor'     =>  '',
        'discipline'    =>  '',
        'student'       =>  '',
        'classes'       =>  '',
        'classroom'     =>  '',
        'plates'        =>  '',
        'grade'         =>  '',
        'evaluation'    =>  '',
        'fouls'         =>  '',
    );

    // function to remove special characters
    public function RemoveSpecialChars($var) {
        
        $var = str_replace(array("à","á","â","ã","ä","è","é","ê","ë","ì","í","î","ï","ò","ó","ô","õ","ö","ù","ú","û","ü","À","Á","Â","Ã","Ä","È","É","Ê","Ë","Ì","Í","Î","Ò","Ó","Ô","Õ","Ö","Ù","Ú","Û","Ü","ç","Ç","ñ","Ñ"),
        array("a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","o","u","u","u","u","A","A","A","A","A","E","E","E","E","I","I","I","O","O","O","O","O","U","U","U","U","c","C","n","N"), $var);
        
        return $var;
    }
}
