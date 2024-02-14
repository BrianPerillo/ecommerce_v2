@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    <div id="contenedor"></div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{--<script> console.log('Hi!'); 
        Echo.channel(`ecommerce-channel`)
        .listen('order-complete', (data) => {
            console.log('Evento escuchado');
        });
    </script>--}}
    <!-- Push min js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js"></script>
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <!-- Pusher Notifications-->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
    var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
      cluster: "{{env('PUSHER_APP_CLUSTER')}}"  
    });

    var channel = pusher.subscribe('ecommerce-channel');
    channel.bind('order-complete', function(data) {
        $("#contenedor").append("<p>Este párrafo se ha añadido dinámicamente</p>");
    });   
    </script>
@stop