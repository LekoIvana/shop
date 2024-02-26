<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function dohvatiGender(){
        $gender = Gender::get();
        return response()->json(['gender' => $gender]);
    }
}
