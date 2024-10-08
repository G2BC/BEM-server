<?php
namespace App\Utils;

class States {
    // Returns the geolocalization of capital of the each state in Brazil
    public static function getGeolocalization(){
        return [
            "AP" => ["latitude" => 0.0355, "longitude" => -51.0705],
            "AC" => ["latitude" => -9.9747, "longitude" => -67.8243],
            "PA" => ["latitude" => -1.4558, "longitude" => -48.5044],
            "CE" => ["latitude" => -3.7172, "longitude" => -38.5434],
            "PI" => ["latitude" => -5.0919, "longitude" => -42.8034],
            "BA" => ["latitude" => -12.9714, "longitude" => -38.5014],
            "GO" => ["latitude" => -16.6864, "longitude" => -49.2643],
            "PB" => ["latitude" => -7.1153, "longitude" => -34.861],
            "RR" => ["latitude" => 2.8235, "longitude" => -60.6758],
            "AL" => ["latitude" => -9.6658, "longitude" => -35.735],
            "AM" => ["latitude" => -3.119, "longitude" => -60.0217],
            "PR" => ["latitude" => -25.4296, "longitude" => -49.2713],
            "MA" => ["latitude" => -2.5307, "longitude" => -44.3068],
            "RO" => ["latitude" => -8.7608, "longitude" => -63.8999],
            "SE" => ["latitude" => -10.9472, "longitude" => -37.0731],
            "PE" => ["latitude" => -8.0476, "longitude" => -34.877],
            "TO" => ["latitude" => -10.2491, "longitude" => -48.3243],
            "SP" => ["latitude" => -23.5505, "longitude" => -46.6333],
            "MT" => ["latitude" => -15.601, "longitude" => -56.0979],
            "MG" => ["latitude" => -19.9167, "longitude" => -43.9345],
            "SC" => ["latitude" => -27.5954, "longitude" => -48.548],
            "ES" => ["latitude" => -20.3155, "longitude" => -40.3129],
            "RJ" => ["latitude" => -22.9068, "longitude" => -43.1729],
            "DF" => ["latitude" => -15.7942, "longitude" => -47.8822],
            "RN" => ["latitude" => -5.7945, "longitude" => -35.211],
            "RS" => ["latitude" => -30.0346, "longitude" => -51.2177],
            "MS" => ["latitude" => -20.4697, "longitude" => -54.6201]
        ];
    }
}
