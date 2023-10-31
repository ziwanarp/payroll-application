<?php

namespace App\Http\Controllers\UserDashboardController;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\NavbarService;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Services\User\HomeService;
use App\Services\User\UpdateProfile;
use App\Services\User\UpdatePassword;
use App\Services\User\PresenceInService;
use App\Services\User\PresenceOutService;

class UserDashboardController extends Controller
{
    private $navbarService;
    private $homeService;
    private $configuration;

    public function __construct()
    {
        $this->navbarService = new NavbarService;
        $this->homeService = new HomeService;
        $this->configuration = new Configuration;
    }

    public function index(){
        $data = $this->navbarService->navbarService();
        $home = $this->homeService->HomeService();
        $in = $this->configuration->in();
        $out = $this->configuration->out();
        return view('home', compact('data','home','in','out'));
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
        $data = $this->navbarService->navbarService();
        return view('user.profile', compact('user','data'));
    }

    public function updatePassword(Request $request){
        $updatePassword = new UpdatePassword;
        return $updatePassword->updatePassword($request);
    }

    public function updateProfile(Request $request){
        $updateProfile = new UpdateProfile;
        return $updateProfile->updateProfile($request);
    }
}
