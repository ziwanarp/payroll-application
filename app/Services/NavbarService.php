<?php

namespace App\Services;

use stdClass;
use App\Models\Presence;
use App\Models\Configuration;

class NavbarService
{
    public function navbarService(){
        $data = new stdClass;
        $collection = Configuration::all();
        foreach($collection as $item){
            if($item->variable == 'time_in'){
                $timeIn = strtotime($item->value);
            } else if($item->variable == 'time_out'){
                $timeOut = strtotime($item->value);
            } 
        }

        $presence = Presence::where('id', auth()->user()->id)->orWhere('date',today())->get();
        if(count($presence) != null){
            $data->value = 'out';
            $data->color = 'success';
            $data->message = 'Go Home!';
            $data->tooltip = 'Saatnya pulang, silahkan absen !';
            $data->link = '/presences/';
        } else {
            if(time() < $timeIn){
                $data->value = 'in';
                $data->color = 'success';
                $data->message = 'Present!';
                $data->tooltip = 'Belum terlambat, silahkan absen';
                $data->link = '/presences/';
            } else if (time() > $timeIn && time() < $timeOut){
                $data->value = 'in';
                $data->color = 'danger';
                $data->message = 'Present!';
                $data->tooltip = 'Anda terlambat, silahkan absen !';
                $data->link = '/presences/';
            } else if (time() > $timeOut && time() < strtotime('23:59:59')){
                $data->value = 'out';
                $data->color = 'success';
                $data->message = 'Go Home!';
                $data->tooltip = 'Saatnya pulang, silahkan absen !';
                $data->link = '/presences/';
            } else {
                $data->value = 'error';
                $data->color = 'error';
                $data->message = 'error';
                $data->tooltip = 'error';
                $data->link = '/api/presences';
            }
        }
        
        return $data;
    }
}