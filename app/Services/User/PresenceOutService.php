<?php

namespace App\Services\User;

use App\Models\Presence;

class PresenceOutService {

    public function presenceOutService(){
        $presence = Presence::where('user_id',auth()->user()->id)->orWhere('date', today())->get();
        if(count($presence) == 0){
            return redirect('/')->with('error','Anda belum melakukan absen masuk hari ini !');
        }

        if($presence[0]->out != null){
            return redirect('/')->with('error','Anda sudah absen pulang hari ini !');
        }

        $presence[0]->out = now();
        $presence[0]->save();

        return redirect('/')->with('success','Absen pulang berhasil !');
    }
    
}