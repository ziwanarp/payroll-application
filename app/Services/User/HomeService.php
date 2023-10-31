<?php

namespace App\Services\User;

use App\Models\Presence;
use Illuminate\Support\Carbon;

class HomeService {
    private $month;

    public function __construct()
    {
        $this->month = Carbon::now()->month;
    }

    public function HomeService(){
        $presence = Presence::where('user_id', auth()->user()->id)->whereMonth('date', $this->month)->get();
        return $presence;
    }

}