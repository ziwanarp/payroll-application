<?php

namespace App\Http\Controllers\UserDashboardController;

use App\Models\User;
use App\Services\NavbarService;
use App\Http\Controllers\Controller;
use App\Services\User\PresenceInService;
use App\Services\User\PresenceOutService;

class UserDashboardController extends Controller
{
    private function navbarService(){
        $navbarService = new NavbarService;
        return $navbarService->navbarService();
    }

    public function index(){
        $data = $this->navbarService();
        return view('welcome', compact('data'));
    }

    public function presenceIn(){
       $PresenceInService = new PresenceInService;
       return $PresenceInService->presenceInService();
    }

    public function presenceOut(){
        $PresenceOutService = new PresenceOutService;
        return $PresenceOutService->presenceOutService();
    }

    public function profile(){
        $user = User::find(auth()->user()->id);
        $data = $this->navbarService();
        return view('user.profile', compact('user','data'));
    }
}
