<?php

namespace App\Http\Controllers\UserDashboardController;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Services\NavbarService;
use App\Services\User\PresenceInService;
use App\Services\User\PresenceOutService;

class UserDashboardController extends Controller
{
    public function index(){
        $navbarData = new NavbarService;
        return $navbarData->navbarService();
    }

    public function presenceIn(){
       $PresenceInService = new PresenceInService;
       return $PresenceInService->presenceInService();
    }

    public function presenceOut(){
        $PresenceOutService = new PresenceOutService;
        return $PresenceOutService->presenceOutService();
    }
}
