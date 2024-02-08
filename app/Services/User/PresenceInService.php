<?php

namespace App\Services\User;

use App\Models\Presence;
use App\Models\Pay;

class PresenceInService {

    public function presenceInService($request){
        if($request->image == null || $request->image == ""){
            return json_encode(["success" => false,"message" => "Image Null !"]);
        }

        if($request->location == null || $request->location == ""){
            return json_encode(["success" => false,"message" => "Location Null !"]);
        }
        
        $presence = Presence::where('user_id',auth()->user()->id)->Where('date', today())->whereNotNull('in')->get();
        if(count($presence) != 0){
            // return back()->with('error','Anda sudah melakukan absen masuk hari ini !');
            return json_encode(["success" => false,"message" => "Anda sudah melakukan absen masuk hari ini !"]);
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

        return json_encode(["success" => true,"message" => "Anda sudah melakukan absen masuk hari ini !"]);
        // return back()->with('success','Absen masuk berhasil !');

    }

}