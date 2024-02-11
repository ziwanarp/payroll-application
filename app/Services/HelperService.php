<?php

namespace App\Services;

use App\Models\Configuration;


class HelperService {

    protected function jarakLokasi ($request){
        $configuration = new Configuration;
        $office_location = explode(',',$configuration->office_location()->value);
        $user_location = explode(',', $request->location);
        // Radius bumi dalam kilometer
        $radius = 6371;

        // Konversi latitude dan longitude dari derajat ke radian
        $latFrom = deg2rad($office_location[0]);
        $lonFrom = deg2rad($office_location[1]);
        $latTo = deg2rad($user_location[0]);
        $lonTo = deg2rad($user_location[1]);

        // Perbedaan latitude dan longitude
        $latDiff = $latTo - $latFrom;
        $lonDiff = $lonTo - $lonFrom;

        // Rumus Haversine
        $a = sin($latDiff / 2) * sin($latDiff / 2) + cos($latFrom) * cos($latTo) * sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $radius * $c;

        return $distance*1000;
    }

}