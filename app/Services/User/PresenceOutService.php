<?php

namespace App\Services\User;

use App\Models\Pay;
use App\Models\Presence;
use App\Models\Configuration;

class PresenceOutService {

    public function presenceOutService(){
        $configuration = new Configuration;
        $presence = Presence::where('user_id',auth()->user()->id)->Where('date', today())->get();
        $pay = Pay::where('user_id',auth()->user()->id)->Where('date', today())->get();

        if(count($presence) == 0){
            return back()->with('error','Anda belum melakukan absen masuk hari ini !');
        }

        if($presence[0]->out != null){
            return back()->with('error','Anda sudah absen pulang hari ini !');
        }

        $presence[0]->out = now();
        $presence[0]->save();

        if(!strtotime($presence[0]->in) <= strtotime($configuration->in()) && strtotime($presence[0]->out) >= strtotime($configuration->out())){
            $pay[0]->deduction = 15000;
            $pay[0]->save();
        }
        return back()->with('success','Absen pulang berhasil !');
    }
    
}