<?php

namespace App\Http\Controllers\UserDashboardController;

use App\Http\Controllers\Controller;
use App\Services\NavbarService;

class UserDashboardController extends Controller
{
    public function index(){
        
        $navbarData = new NavbarService;
        $data = $navbarData->navbarService();
        return view('welcome', compact('data'));
    }
}
