<?php

namespace App\Services\User;

use App\Models\User;

class UpdateProfile {

    public function updateProfile($request){
        $user = User::find(auth()->user()->id);

        if($user->name == $request->name && $user->username == $request->username && $user->email == $request->email){
            return back()->with('error_profile','Data profile tidak ada perubahan!');
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return back()->with('success_profile', 'Data profile telah di ubah!');
    }

}