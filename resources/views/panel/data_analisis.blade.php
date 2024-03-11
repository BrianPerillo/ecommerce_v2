<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center mt-4">
        <div id="chart-container">
                <canvas id="chart" width="400px" height="400px"></canvas>
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

        // Obtenemos el contenedor donde queremos colocar los gráficos
        var container = document.getElementById('chart-container');

        var products = <?php echo json_encode($products); ?>;

        var orders = <?php echo json_encode($orders); ?>;

        var productCounts = {};

        //Se calculan órdenes por producto
        orders.forEach(function(order) {
            // Itera sobre todos los productos dentro de la orden
            order.products.forEach(function(product) {
                var productName = product.product_detail.name;
                
                // Verifica si el producto ya existe en el objeto de conteo
                if (productCounts.hasOwnProperty(productName)) {
                    // Incrementa el contador de órdenes para este producto
                    productCounts[productName]++;
                } else {
                    // Inicializa el contador de órdenes para este producto en 1
                    productCounts[productName] = 1;
                }
            });
        });

        var labels = [];

        //Se agrega como label el nombre de cada producto iterado
        products.forEach(function(product){ 
            // Verifica si el nombre del producto ya está en el array de etiquetas
            if (!labels.includes(product.name)) {
                // Agrega el nombre del producto al array de etiquetas
                labels.push(product.name);
            }
        });

        var data = [];
        products.forEach(function(product){ 
            // Verifica si el nombre del producto ya está en el array de etiquetas
            if (!labels.includes(product.name)) {
                // Agrega el nombre del producto al array de etiquetas
                labels.push(product.name);
            }
        });



        var canvasId = 'chart';
        var ctx = document.getElementById(canvasId).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico
            data: {
                labels: labels, // Etiquetas de los productos
                datasets: [{
                    label: '# ventas por producto',
                    data: productCounts, // Datos de ventas
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
                        beginAtZero: true, // Empezar el eje Y en cero
                        min: 0, // Establece el valor mínimo del eje Y en 0
                        max: 10, // Establece el valor máximo del eje Y
                        stepSize: 1 // Establece el tamaño del paso en el eje Y a 1
                    }
                }
            }
        });


        console.log(labels);
    </script>

    @stop
