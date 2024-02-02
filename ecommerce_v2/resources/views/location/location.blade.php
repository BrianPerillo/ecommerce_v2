<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12 bg-white">


        <div class="container">
            <h1 style="text-align:center">Tiendas</h1>

            <!--The div element for the map -->
            <div style="height: 450px" id="map"></div>

        </div>

        <section class="container" style="margin-top:25px ">

            <h5 class="text-center">Buscar Farmacias Cercanas</h5>
            <form id="search_stores_aut" action="#" class="my-5 row text-center flex-grow-1">
    
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
    
            </form>

            <div class="stores">
                  <!-- title -->
            </div>

            <div class="row">
                <div id="results-grid" class="container mt-5 row">
                    <!-- resultados -->
                </div>
            </div>
    
        </section>
<!-- 
        <form id="search_stores_aut" action="{{ route('location.search') }}" class="my-5 row text-center flex-grow-1">
    
            <div class="col-12 d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </div>

        </form>
-->
    </div>


    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous">
    </script>
     <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtey5MySbKjp_kcyYGg8WLy4d5PY5SEqU&callback=initMap"></script>-->

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLEMAPS_API_KEY')}}"></script>
    <script>
       // Initialize and add the map
        let map;

        async function initMap() {
            // The location of Uluru
            const position = { lat: -34.9298514, lng: -57.9624017};
            // Request needed libraries.
            //@ts-ignore
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

            // The map, centered at Uluru
            map = new Map(document.getElementById("map"), {
                zoom: 13,
                center: position,
                mapId: "DEMO_MAP_ID",
            });
            var marker = new google.maps.Marker({
                position: {lat: -34.9298514, lng: -57.9624017},
                map: map
            });
            
        }

        initMap();

   
    </script>
 
    <!-- prettier-ignore -->
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyAtey5MySbKjp_kcyYGg8WLy4d5PY5SEqU", v: "beta"});
    </script>

    {{-- Relizar petición a la api --}}
    @include('location.locationRequest')

    <!-- resultados -->
    <!-- resultados -->
    <!-- resultados -->
    <!-- resultados -->
    <!-- resultados -->


</x-app-layout>