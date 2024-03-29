<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService {

    public function LoginService($request){
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();
        if($user != null){
            if($user->account_active == 0 ){
                return back()->with('error', 'Akun anda nonaktif, harap hubungi atasan!');
            }
        }

        // if($user->user_active == 1){
        //     return back()->with('error', 'Akun anda sedang login di device lain (IP:'.$user->ip_login.') !');
        // }

        if (Auth::attempt($credentials)) {

            $user->last_login = now();
            $user->user_active = 1;
            $user->ip_login = $request->ip();
            $user->save();

            return redirect()->intended('/');
        }
        return back()->with('error', 'Wrong credentials !');
    }

}