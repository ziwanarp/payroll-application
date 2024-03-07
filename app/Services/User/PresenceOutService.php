<?php

namespace App\Services\User;

use App\Models\Pay;
use App\Models\Presence;
use App\Models\Configuration;
use App\Services\HelperService;
use Illuminate\Support\Facades\Storage;

class PresenceOutService extends HelperService {

    public function presenceOutService($request){

        if($request->image == null || $request->image == ""){
            return json_encode(["success" => false,"message" => "Image Null !"]);
        }
        if($request->location == null || $request->location == ""){
            return json_encode(["success" => false,"message" => "Location Null !"]);
        }

        $configuration = new Configuration;
        $presence = Presence::where('user_id',auth()->user()->id)->Where('date', today())->get();
        $pay = Pay::where('user_id',auth()->user()->id)->Where('date', today())->get();

        if(count($presence) == 0){
            // return back()->with('error','Anda belum melakukan absen masuk hari ini !');
            return json_encode(["success" => false,"message" => "Anda belum melakukan absen masuk hari ini !"]);
        }

        if($presence[0]->out != null){
            // return back()->with('error','Anda sudah absen pulang hari ini !');
            return json_encode(["success" => false,"message" => "Anda sudah absen pulang hari ini !"]);
        }

        $distance = $this->jarakLokasi($request);
        if($distance >= 500){
            return json_encode(["success" => false,"message" => "Jarak anda > 500M dengan kantor !"]);
        }

        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
        $imageName = 'presence-image/'.auth()->user()->username.'_'.uniqid() . '_out.png';
        Storage::disk('public')->put($imageName, $imageData);

        $presence[0]->out = now();
        $presence[0]->location_out = $request->location;
        $presence[0]->image_out = $imageName;
        $presence[0]->save();

        if(!strtotime($presence[0]->in) <= strtotime($configuration->in()) && strtotime($presence[0]->out) >= strtotime($configuration->out())){
            $pay[0]->deduction = $configuration->deduction()->value;
            $pay[0]->save();
        }
        // return back()->with('success','Absen pulang berhasil !');
        return json_encode(["success" => true,"message" => "Anda berhasil melakukan absen pulang hari ini !"]);
    }
    
}