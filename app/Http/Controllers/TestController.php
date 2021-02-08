<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show3b(){
        return view('test.opdracht3b');
    }
    public function show3d($id){
        return view('test.opdracht3d')->with('param',$id);
    }
}
