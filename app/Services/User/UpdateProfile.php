<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends User {

    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function updateProfile($request)
    {
        if($this->user->getName() == $request->name && $this->user->getUsername() == $request->username && $this->user->getEmail() == $request->email){
            return back()->with('error_profile','Data profile tidak ada perubahan!');
        }
        $this->user->setName($request->name);
        $this->user->setUsername($request->username);
        $this->user->setEmail($request->email);

        return back()->with('success_profile', 'Data profile telah di ubah!');
    }

    public function updatePicture($request)
    {
        $validatedData = $request->validate([
            'profilePicture' => 'image|file|max:512|mimes:jpg,jpeg,png'
        ]);

        if ($request->file('profilePicture')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('profilePicture')->store('picture-profile');
        }
        $this->user->setPicture($validatedData['image']);

        return back()->with('success_password', 'Foto profile telah di ubah!');

    }

}