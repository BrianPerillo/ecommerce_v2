<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center mt-4">
        <div id="chart-container">
            @for ($i = 0; $i < count($orders); $i += 2)
                <div class="row">
                    @php
                        $chunk = array_slice($orders, $i, 2);
                    @endphp
                    @foreach ($chunk as $order)
                        <div class="col-md-6">
                            <canvas id="chart-{{$order->id}}" width="400" height="400"></canvas>
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>

   {{-- @foreach($orders as $order) 
        <p>{{$order->id}}</p>
    @endforeach--}}
</div>

    @stop
    
    @section('css')        
        @livewireStyles
        <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
        <!-- Drag & Drop -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
        <link rel="stylesheet" href="{{ asset('css/draganddrop.css') }}">
        <!-- Estilos para alertas js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stop
    

    @section('js')      
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- toasts js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <script>
        var chartData = <?php echo json_encode($orders); ?>;
    
        console.log(chartData[0]['id']);

        // Obtenemos el contenedor donde queremos colocar los gráficos
        var container = document.getElementById('chart-container');
    
        chartData.forEach(function(order) {
            var canvasId = 'chart-' + order.id;
            var ctx = document.getElementById(canvasId).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // Tipo de gráfico
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], // Ejemplo de etiquetas
                    datasets: [{
                        label: '# ventas por producto', // Ejemplo de etiqueta de leyenda
                        data: [12, 19, 3, 5, 2, 3], // Ejemplo de datos
                        backgroundColor: [ // Colores de fondo para cada barra
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [ // Colores de borde para cada barra
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1 // Ancho del borde de las barras
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Empezar el eje Y en cero
                        }
                    }
                }
            });
        });
    </script>

    @stop
