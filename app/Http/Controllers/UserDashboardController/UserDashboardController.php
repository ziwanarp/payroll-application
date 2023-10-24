<?php

namespace App\Http\Controllers\UserDashboardController;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use stdClass;

class UserDashboardController extends Controller
{
    public function index(){
        $data = new stdClass;
        $collection = Configuration::all();
        foreach($collection as $item){
            if($item->variable == 'time_in'){
                if(strtotime($item->value) > time()){
                    $data->time_in = 'success';
                } else {
                    $data->time_in = 'danger';
                }
            } 
        }
        return view('welcome', compact('data'));
    }
}
