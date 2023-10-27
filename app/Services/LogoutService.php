<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogoutService {

    public function LogoutService($request){
        $user = User::find(auth()->user()->id);
        $user->user_active = 0;
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}