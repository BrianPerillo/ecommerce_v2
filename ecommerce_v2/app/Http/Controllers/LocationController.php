<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Store;

class LocationController extends Controller
{
    
    public function show(){ 

        $stores = Store::get()->all();

        return view('location.location')->with(compact('stores'));

    }

    public function search(Request $request)
    {

        $data = $request->all();
        $maxResultados = 3;
        $lat = $data['lat'];
        $long = $data['long'];
    
        // Creación clave única caché
        $cacheKey = 'search_' . $lat . '_' . $long . rand(1,100000);
    
  
        // Recupero ubicaciones anteriores almacenadas en caché
        $cachedLocations = Cache::get('cachedLocations', []);
    
        // Verifico si la respuesta está en caché
        if (Cache::has($cacheKey)) {
            $origin = Cache::get($cacheKey);
    
            // Si la respuesta viene de la caché, devolver las direcciones almacenadas en caché
            if (isset($origin['fromCache']) && $origin['fromCache']) {
                return response()->json(['pharmacies' => $cachedLocations, 'cachedLocations' => $origin]);
            }
        }
    /*
        //Defino Booleano para Distancia
        $isCloseToCachedLocation = false;
    
        $filterCachedLocations = [];

        // Compara la distancia de la ubicacion recibida contra la de las ubicaciones almacenadas en caché
        foreach ($cachedLocations as $cachedLocation) {
            
            $cachedLat = $cachedLocation['lat'];
            $cachedLong = $cachedLocation['long'];
    
            // Calcula la distancia entre las ubicaciones
            $locationCalculator = new LocationCalculator();
            $distance = $locationCalculator->calculateDistance($lat, $long, $cachedLat, $cachedLong);
    
            // Si la distancia es menor o igual a 10 metros, cambia $isCloseToCachedLocation
            if ($distance <= 10) {
                $isCloseToCachedLocation = true;
                $filterCachedLocations[] = $cachedLocation;
            }
        }
    
        // Si está cerca de alguna ubicación en caché, devuelve desde la caché
        if ($isCloseToCachedLocation) {
            $origin = ['fromCache' => true];
            return response()->json(['pharmacies' => $filterCachedLocations, 'cachedLocations' => $origin]);
        }
    
        // Si no está cerca de ninguna ubicación en caché, consulta a la base y almacena en caché
        $nearPharmacies = Pharmacy::selectRaw('*, (6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(`long`) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distancia', [$lat, $long, $lat])
        ->orderBy('distancia')
        ->take($maxResultados)
        ->get();
    
                
        foreach ($nearPharmacies as $pharmacy) {
            $cachedLocations[] = [
                'name' => $pharmacy->name,
                'address' => $pharmacy->address,
                'lat' => $lat,
                'long' => $long,
            ];
        }

        Cache::put('cachedLocations', $cachedLocations, now()->addMinutes(10));
    
        Cache::put($cacheKey, $nearPharmacies, now()->addMinutes(10));
    
        $origin['fromCache'] = false;

        return response()->json(['pharmacies' => $nearPharmacies, 'cachedLocations' => $origin]);*/

    }



}
