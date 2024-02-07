
<script>
    $(document).ready(function () {

    //Buscar Farmacias cercanas
    $('#search_stores_aut').submit(function (e) {
                e.preventDefault();
            
                // Verificar si el navegador admite la geolocalización
                if ("geolocation" in navigator) {
                    // Solicitar la ubicación al usuario
                    navigator.geolocation.getCurrentPosition(function(position) {
                        
                        // Obtener las coordenadas de latitud y longitud
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        let apiUrlSearch = '{{ route('location.search') }}';

                        // Log
                        console.log("Ubicación obtenida:", "Latitud: " + latitude + ", Longitud: " + longitude);

                        const title = $('.stores');
                        title.empty(); // Limpia cualquier contenido previo

                        const resultsGrid = $('#results-grid');
                        resultsGrid.empty(); // Limpia cualquier contenido previo

                        Swal.fire({
                            title: 'Buscando...',
                            allowOutsideClick: false, 
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            },
                        });
                        $.ajax({
                        url: apiUrlSearch,
                        dataType: 'json', 
                        data: {
                            _token: '{{ csrf_token() }}',
                            lat: latitude,
                            long: longitude
                        },
                        success: function (data) {
                            Swal.close();
                            console.log(data);

                            // Procesa y muestra los resultados en cards de Bootstrap
                            const resultsGrid = $('#results-grid');
                            resultsGrid.empty(); // Limpia cualquier contenido previo

                            //Iteración de la data recibida y se agregan cards al front
                                console.log(data.store);
                                const card = `
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title text-center">${data.store.city}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text text-center" style="font-size:15px">${data.store.street} ${data.store.street_number}</p>
                                                <p class="card-text text-center" style="font-size:15px">Tel.: ${data.store.phone}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                resultsGrid.append(card);
                            
                            //Incrustar Mapa:
                            // Initialize and add the map
                            let map;

                            async function initMap() {
                                // The location of Uluru
                                const position = { lat: data.store.lat, lng: data.store.long};
                                // Request needed libraries.
                                //@ts-ignore
                                const { Map } = await google.maps.importLibrary("maps");
                                const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

                                // The map, centered at Uluru
                                map = new Map(document.getElementById("map"), {
                                    zoom: 14,
                                    center: position,
                                    mapId: "DEMO_MAP_ID",
                                });
                                var marker = new google.maps.Marker({
                                    position: {lat: data.store.lat, lng: data.store.long},
                                    map: map
                                });
                                console.log('asdf');
                            }

                            initMap();

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops! Error al buscar',
                                text: jqXHR.responseText,
                            })
                        }
                    });
                        
                    }, function(error) {
                        // Manejar de errores
                        Swal.fire({
                            icon: 'error',
                            title: "Error al obtener la ubicación",
                            text: jqXHR.responseText,
                        })
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: "El navegador no soporta geolocalización",
                        text: jqXHR.responseText,
                    })
                }


            });

    });

</script>
