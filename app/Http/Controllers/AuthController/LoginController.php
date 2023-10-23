<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index (){
        return view('login');
    }

    public function login (Request $request){
        dd($request);
    }
}
