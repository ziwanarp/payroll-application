<?php

namespace App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LoginService;
use App\Services\LogoutService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index (){
        return view('login');
    }

    public function login (Request $request){
        $LoginService = new LoginService;
        return $LoginService->LoginService($request);
    }

    public function logout (Request $request)
    {
        $LogoutService = new LogoutService;
        return $LogoutService->LogoutService($request);
    }
}
