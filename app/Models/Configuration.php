<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function in(){
        return Configuration::select('value')->where('variable','time_in')->first();
    }

    public function out(){
        return Configuration::select('value')->where('variable','time_out')->first();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
