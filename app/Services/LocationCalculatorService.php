<?php

namespace App\Services;

use App\Services;
use Illuminate\Support\Facades\Cache;

class LocationCalculatorService
{

    // Calcular la distancia entre dos ubicaciones
    public function calculateDistance($lat1, $long1, $lat2, $long2)
    {
        $earthRadius = 6371000; // Radio de la Tierra en metros

        $lat1Rad = deg2rad($lat1);
        $long1Rad = deg2rad($long1);
        $lat2Rad = deg2rad($lat2);
        $long2Rad = deg2rad($long2);
    
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLong = $long2Rad - $long1Rad;
    
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($deltaLong / 2) * sin($deltaLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c;
    
        return $distance;
    }

    public function isInCache($cacheKey){
    
        // Verifico si la respuesta está en caché. Si ya se buscó desde la misma ubicación.
        if (Cache::has($cacheKey)) {
            $origin = Cache::get($cacheKey);
            // Si la respuesta viene de la caché, devolver las direcciones almacenadas en caché
            return $origin;
        }

        return null;

    }

}