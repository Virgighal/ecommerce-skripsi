<?php 

namespace App\Services;

use App\Models\Location;
use Location\Coordinate;
use Location\Distance\Vincenty;

class RadiusCheckerService
{
    /**
     * get distance
     */
    public static function getDistance($latitude, $longitude)
    {
        $restoLocation = Location::where('name', "Warung Mbo'e")->first();
        if (empty($restoLocation)) {
            return '';
        }
        
        $restoLocationLongitude = (float) $restoLocation->longitude;
        $restoLocationLatitude = (float) $restoLocation->latitude;

        $restoLocationCoordinate = new Coordinate($restoLocationLatitude, $restoLocationLongitude);
        $userCordinate = new Coordinate($latitude, $longitude);

        $calculator = new Vincenty();

        return $calculator->getDistance($restoLocationCoordinate, $userCordinate);
    }

}