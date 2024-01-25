<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'salary',
        'role',
        'last_login',
        'user_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $with = ['pays', 'presences','role'];

    public function pays() {
        return $this->hasMany(Pay::class);
    }

    public function presences() {
        return $this->hasMany(Presence::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    protected function setName($name){
        $data = User::find(auth()->user()->id);
        $data->name = $name;
        $data->save();
    }

    protected function setUsername($username){
        $data = User::find(auth()->user()->id);
        $data->username = $username;
        $data->save();
    }

    protected function setEmail($email){
        $data = User::find(auth()->user()->id);
        $data->email = $email;
        $data->save();
    }

    protected function setPicture($picture){
        $data = User::find(auth()->user()->id);
        $data->picture = $picture;
        $data->save();
    }

    protected function getName(){
        $data = User::find(auth()->user()->id);
        return $data->name;
    }

    protected function getUsername(){
        $data = User::find(auth()->user()->id);
        return $data->username;
    }

    protected function getEmail(){
        $data = User::find(auth()->user()->id);
        return $data->email;
    }
}
