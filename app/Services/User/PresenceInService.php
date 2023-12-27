<?php

namespace App\Services\User;

use App\Models\Presence;
use App\Models\Pay;

class PresenceInService {

    public function presenceInService(){
        $presence = Presence::where('user_id',auth()->user()->id)->Where('date', today())->whereNotNull('in')->get();
        if(count($presence) != 0){
            return back()->with('error','Anda sudah melakukan absen masuk hari ini !');
        }

        $presenceIn = new Presence([
            'user_id' => auth()->user()->id,
            'in' => now(),
            'out' => null,
            'date' => today(),
        ]);
        $presenceIn->save();

        $pay = new Pay([
            'user_id' => auth()->user()->id,
            'allowance' => 30000,
            'deduction' => 0,
            'date' => today(),
        ]);
        $pay->save();

        return back()->with('success','Absen masuk berhasil !');

    }

}