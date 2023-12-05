<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

    public function updatePicture($request){
        $validatedData = $request->validate([
            'profilePicture' => 'image|file|max:512|mimes:jpg,jpeg,png'
        ]);

        if ($request->file('profilePicture')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('profilePicture')->store('picture-profile');
        }

        $user = User::find(auth()->user()->id);
        $user->picture = $validatedData['image'];
        $user->save();

        return back()->with('success_password', 'Foto profile telah di ubah!');

    }

}