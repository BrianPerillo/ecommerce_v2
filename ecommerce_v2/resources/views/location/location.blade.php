<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12 bg-white">

        <div class="container" style="overflow: hidden">
            <h1>Tiendas</h1>
        </div>

        @if(isset($stores) && $stores !== null)
            <div>
                @foreach($stores as $store)
                    <p>{{$store->country}}</p>  
                    <p>{{$store->state}}</p>  
                    <p>{{$store->city}}</p>  
                    <p>{{$store->street}}</p>  
                    <p>{{$store->streetnumber}}</p>  
                @endforeach
            </div>
        @endif

        <div class="col-lg-6 d-flex flex-column">
            <h5 class="text-center">Buscar Farmacias Cercanas con Ubicación del navegador</h5>

            <form id="search_stores_aut" action="#" class="my-5 row text-center flex-grow-1">
    
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
    
            </form>
        </div>

        <section class="container">
            <div class="stores">
                  <!-- title -->
            </div>
            <div class="row">
                <div id="results-grid" class="container mt-5 row">
                    <!-- resultados -->
                </div>
            </div>
    
        </section>


    </div>

    
    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous">
    </script>


    {{-- Relizar petición a la api --}}
    @include('location.locationRequest')

    <!-- resultados -->
    <!-- resultados -->
    <!-- resultados -->
    <!-- resultados -->
    <!-- resultados -->


</x-app-layout>