<?php

namespace App\Services\User;

use App\Models\Pay;
use App\Models\Presence;
use Illuminate\Support\Facades\Storage;

class PresenceInService {

    public function presenceInService($request){
        if($request->image == null || $request->image == ""){
            return json_encode(["success" => false,"message" => "Image tidak berhasil di capture !"]);
        }
        if($request->location == null || $request->location == ""){
            return json_encode(["success" => false,"message" => "Location tidak berhasil di kirim !"]);
        }
        
        $presence = Presence::where('user_id',auth()->user()->id)->Where('date', today())->whereNotNull('in')->get();
        if(count($presence) != 0){
            // return back()->with('error','Anda sudah melakukan absen masuk hari ini !');
            return json_encode(["success" => false,"message" => "Anda sudah melakukan absen masuk hari ini !"]);
        }

        //implementasi jarak antara device dan office
        //===========================================

        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
        $imageName = 'presence-image/'.auth()->user()->username.'_'.uniqid() . '_in.png';
        Storage::disk('public')->put($imageName, $imageData);

        $presenceIn = new Presence([
            'user_id' => auth()->user()->id,
            'in' => now(),
            'out' => null,
            'date' => today(),
            'image_in' => $imageName,
            'image_out' => null,
            'location_in' => $request->location,
            'location_out' => null
        ]);
        $presenceIn->save();

        $pay = new Pay([
            'user_id' => auth()->user()->id,
            'allowance' => 30000,
            'deduction' => 0,
            'date' => today(),
        ]);
        $pay->save();

        return json_encode(["success" => true,"message" => "Anda berhasil melakukan absen masuk!"]);
        // return back()->with('success','Absen masuk berhasil !');

    }

}