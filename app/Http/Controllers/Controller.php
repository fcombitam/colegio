<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function generateRandomStringSubject($length = 12) {
        $characters = 'ABCDEFGHJKMNPQRSTWXYZ2345789';
        $charactersLength = strlen($characters);
        $randomCharacters = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCharacters .= $characters[rand(0, $charactersLength - 1)];
        }
        $duplicate = Subject::where('code', $randomCharacters)->first();
        if($duplicate){
            $randomCharacters = $this->generateRandomStringSubject();
        }
        return $randomCharacters;
    }

    function generateRandomStringCourse($length = 12) {
        $characters = 'ABCDEFGHJKMNPQRSTWXYZ2345789';
        $charactersLength = strlen($characters);
        $randomCharacters = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCharacters .= $characters[rand(0, $charactersLength - 1)];
        }
        $duplicate = Course::where('code', $randomCharacters)->first();
        if($duplicate){
            $randomCharacters = $this->generateRandomStringCourse();
        }
        return $randomCharacters;
    }

    function generateRandomStringStudent($length = 12) {
        $characters = 'ABCDEFGHJKMNPQRSTWXYZ2345789';
        $charactersLength = strlen($characters);
        $randomCharacters = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCharacters .= $characters[rand(0, $charactersLength - 1)];
        }
        $duplicate = Student::where('code', $randomCharacters)->first();
        if($duplicate){
            $randomCharacters = $this->generateRandomStringStudent();
        }
        return $randomCharacters;
    }
}
