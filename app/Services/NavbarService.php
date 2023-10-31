<?php

namespace App\Services;

use stdClass;
use App\Models\Presence;
use App\Models\Configuration;

class NavbarService
{
    private $link;
    private $configuration;

    public function __construct()
    {
        $this->link = '/presences/';
        $this->configuration = new Configuration;
    }

    public function navbarService(){
        $data = new stdClass;
        $timeIn = strtotime($this->configuration->in());
        $timeOut = strtotime($this->configuration->out());

        $presence = Presence::where('user_id', auth()->user()->id)->where('date',today())->get();
        if(count($presence) != 0){
            $data->value = 'out';
            $data->color = 'success';
            $data->message = 'Go Home!';
            $data->tooltip = 'Saatnya pulang, silahkan absen !';
            $data->link = $this->link;
        } else {
            if(time() < $timeIn){
                $data->value = 'in';
                $data->color = 'success';
                $data->message = 'Present!';
                $data->tooltip = 'Belum terlambat, silahkan absen';
                $data->link = $this->link;
            } else if (time() > $timeIn && time() < $timeOut){
                $data->value = 'in';
                $data->color = 'danger';
                $data->message = 'Present!';
                $data->tooltip = 'Anda terlambat, silahkan absen !';
                $data->link = $this->link;
            } else if (time() > $timeOut && time() < strtotime('23:59:59')){
                $data->value = 'out';
                $data->color = 'success';
                $data->message = 'Go Home!';
                $data->tooltip = 'Saatnya pulang, silahkan absen !';
                $data->link = $this->link;
            } else {
                $data->value = 'error';
                $data->color = 'error';
                $data->message = 'error';
                $data->tooltip = 'error';
                $data->link = $this->link;
            }
        }
        
        return $data;
    }
}