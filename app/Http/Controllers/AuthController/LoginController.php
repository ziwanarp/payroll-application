<?php

namespace App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index (){
        return view('login');
    }

    public function login (Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->with('error', 'Wrong credentials !');
    }
}
