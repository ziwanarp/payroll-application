<?php

namespace App\Services\User;

use App\Models\Presence;
use Illuminate\Support\Carbon;

class HomeService {
    private $month;

    public function __construct()
    {
        $this->month = Carbon::now()->format('Y-m');
    }

    public function HomeService($request){
        if(isset($request->bulan) || $request->bulan == !null){
            if (!preg_match('/^\d{4}-\d{2}$/', $request->bulan)) {
                $month = substr($this->month, 5,);
                $year = substr($this->month, 0,4);
            } else {
                $month = substr($request->bulan, 5,);
                $year = substr($request->bulan, 0,4);
            }
        } else {
            $month = substr($this->month, 5,);
            $year = substr($this->month, 0,4);
        }

        $presence = Presence::where('user_id', auth()->user()->id)->whereMonth('date',$month)->whereYear('date', $year)->get();
        return ['presence' => $presence, 'month' => $year.'-'.$month];
    }

}