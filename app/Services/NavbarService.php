<?php

namespace App\Services;

use stdClass;
use App\Models\Presence;
use App\Models\Configuration;
use Illuminate\Support\Carbon;

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
        $in = $this->configuration->in() ;
        $out = $this->configuration->out();
        
        $timeIn = strtotime($in->value);
        $timeOut = strtotime($out->value);

        $presence = Presence::where('user_id', auth()->user()->id)->where('date',today())->get();

        if (Carbon::now()->dayOfWeek == Carbon::SATURDAY || Carbon::now()->dayOfWeek == Carbon::SUNDAY) {
            $data->value = 'false';
            $data->color = 'secondary';
            $data->message = 'Hari Libur';
            $data->tooltip = 'Tidak bisa absen, ini hari libur!';
            $data->link = $this->link;
            $data->buttonStatus = 'disabled';
        } else {
            if(count($presence) != 0){
                $data->value = 'out';
                $data->color = 'success';
                $data->message = 'Go Home!';
                $data->tooltip = 'Saatnya pulang, silahkan absen !';
                $data->link = $this->link;
                $data->buttonStatus = '';
            } else {
                if(time() < $timeIn){
                    $data->value = 'in';
                    $data->color = 'success';
                    $data->message = 'Present!';
                    $data->tooltip = 'Belum terlambat, silahkan absen';
                    $data->link = $this->link;
                    $data->buttonStatus = '';
                } else if (time() > $timeIn && time() < $timeOut){
                    $data->value = 'in';
                    $data->color = 'danger';
                    $data->message = 'Present!';
                    $data->tooltip = 'Anda terlambat, silahkan absen !';
                    $data->link = $this->link;
                    $data->buttonStatus = '';
                } else if (time() > $timeOut && time() < strtotime('23:59:59')){
                    $data->value = 'out';
                    $data->color = 'success';
                    $data->message = 'Go Home!';
                    $data->tooltip = 'Saatnya pulang, silahkan absen !';
                    $data->link = $this->link;
                    $data->buttonStatus = '';
                } else {
                    $data->value = 'error';
                    $data->color = 'error';
                    $data->message = 'error';
                    $data->tooltip = 'error';
                    $data->link = $this->link;
                    $data->buttonStatus = '';
                }
            }
        }
        
        return $data;
    }
}