<?php

namespace App\Services\User;

use App\Models\User;

class UpdatePassword{

    public function updatePassword($request){
        $user = User::find(auth()->user()->id);
        
        if($request->password != $request->new_password){
            return back()->with('error_password', 'Password dan confirmation password tidak sama!');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success_password', 'Ubah password berhasil!');
    }

}