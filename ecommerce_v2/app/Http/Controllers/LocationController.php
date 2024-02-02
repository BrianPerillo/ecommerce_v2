<?php

namespace App\Http\Controllers;

use App\Services\LocationCalculatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Store;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use Geocoder\Geocoder;
use GuzzleHttp\Client; 
use Geocoder\StatefulGeocoder;
use Geocoder\Provider\GoogleMaps\GoogleMaps;

class LocationController extends Controller
{

    public function __construct(
        private LocationCalculatorService $locationCalculator
    ) {}
    
    public function show(){ 

        $stores = Store::get()->all();

        return view('location.location')->with(compact('stores'));

    }

    public function search(Request $request)
    {   
        //Guardamos data recibida:
        $data = [];
        $data['lat'] = -34.9298454;
        $data['long'] = -57.9623982;

        //$data = $request->all();
        $maxResultados = 3;
        $lat = $data['lat'];
        $long = $data['long'];

        //Defino Booleano para Distancia
        $isCloseToCachedLocation = false;
    
        $filterCachedLocations = [];
    
    /* ## Verificación Caché ## */

        // Recupero ubicaciones anteriores almacenadas en caché
        $cachedLocations = Cache::get('cachedLocations', []);

        // Creación clave única caché
        $cacheKey = 'search_' . $lat . '_' . $long;
    
        // Vemos si ya tenemos la $cacheKey. Si ya se consulto desde la misma ubicación
        $isInCache = $this->locationCalculator->isInCache($cacheKey);
     
        if($isInCache != null){ //Si la cacheKey ya estaba en cache se devuelven los datos desde caché.
            return response()->json(['stores' => $isInCache, 'fromCache' => true]);
        }

        // Compara la distancia de la ubicacion recibida contra la de las ubicaciones almacenadas en caché
        foreach ($cachedLocations as $cachedLocation) {
            
            $cachedLat = $cachedLocation['lat'];
            $cachedLong = $cachedLocation['long'];
    
            // Calcula la distancia entre las ubicaciones
            $distance = $this->locationCalculator->calculateDistance($lat, $long, $cachedLat, $cachedLong);

            // Si la distancia es menor o igual a 10 metros, cambia $isCloseToCachedLocation
            if ($distance <= 10) {
                $isCloseToCachedLocation = true;
                $filterCachedLocations[] = $cachedLocation;
            }
        }
    
        // Si está cerca de alguna ubicación en caché, devuelve desde la caché
        if ($isCloseToCachedLocation) {
            $origin = ['fromCache' => true];
            return response()->json(['stores' => $filterCachedLocations, 'cachedLocations' => $origin]);
        }
    

    /* ## Si no está en caché o al dirección dada no está cerca de ninguna otra ubicación en caché: ## */

        //Obtengo latitud y longitud de las direcciones en la base de datos
        $stores = Store::get()->all();

        $httpClient = new Client();
        $provider = new GoogleMaps($httpClient, null, env('GOOGLEMAPS_API_KEY'));
        $geocoder = new StatefulGeocoder($provider, 'en');

        //Array para guardar la data de la tienda más las coordenadas que se obtendrán.
        $storeFullData = [];

        foreach($stores as $store){
            $fullAddress = $store->street . ' ' . $store->street_number . ' ' . $store->city . ' ' . $store->state . ' ' . $store->country;
            
            //Calculamos las coordenadas y guardamos en array con demas data de la tienda
            $geoData = $geocoder->geocode($fullAddress);
            $getCoordinates = $geoData->get(0)->getCoordinates();

            // Calcula la distancia entre las ubicaciones
            $distance = $this->locationCalculator->calculateDistance($lat, $long, $getCoordinates->getLatitude(), $getCoordinates->getLongitude());
        
            $storeFullData[] = [
                'id' => $store->id,
                'lat' => $getCoordinates->getLatitude(), 
                'long' => $getCoordinates->getLongitude(),
                'street' => $store->street, 
                'street_number' => $store->street_number,
                'city' => $store->city,
                'state' => $store->state, 
                'country' => $store->country,
                'distance' => intval(round($distance))
            ];

        }

        //dd($storeFullData);
        //dd(intval(round(4.4089896203967)));
        //dd(min(4.6089896203967, 4.6089896203966));

        $minDistance = $storeFullData[0]['distance'];

        $nearestStore = null;

        foreach ($storeFullData as $data) {

            if($data['distance'] <= $minDistance){
                $minDistance = $data['distance'];
                $nearestStore = $data;
                $cachedLocations[] = $nearestStore;
            }

        }

        Cache::put('cachedLocations', $cachedLocations, now()->addMinutes(10));
    
        Cache::put($cacheKey, $nearestStore, now()->addMinutes(10));
    
        $origin['fromCache'] = false;

        return response()->json(['stores' => $nearestStore, 'cachedLocations' => $origin]);
        
    }



}
