<?php

namespace App\Http\Controllers\UserDashboardController;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Services\NavbarService;
use App\Services\User\HomeService;
use App\Http\Controllers\Controller;
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

    public function index(Request $request){
        $homeData = $this->homeService->HomeService($request);
        $home = $homeData['presence'];
        $month = $homeData['month'];

        $data = $this->navbarService->navbarService();
        $in = $this->configuration->in();
        $out = $this->configuration->out();
        $active = 'home';
        $title = 'Dashboard Absensi - Payroll App';
        return view('home', compact('data','home','in','out', 'active', 'title', 'month'));
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
        $active = 'profile';
        $title = 'Profile Page - Payroll App';
        return view('user.profile', compact('user','data', 'active', 'title'));
    }

    public function updatePassword(Request $request){
        $updatePassword = new UpdatePassword;
        return $updatePassword->updatePassword($request);
    }

    public function updateProfile(Request $request){
        $updateProfile = new UpdateProfile;
        return $updateProfile->updateProfile($request);
    }

    public function statistic(){
        
    }

    public function updateProfilePicture(Request $request){
        $upateProfilePicture = new UpdateProfile;
        return $upateProfilePicture->updatePicture($request);
    }
}