<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!-- Bootstrap -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
            <!-- Slider -->
            <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
            <!-- Product Card -->
            <link rel="stylesheet" href="{{ asset('css/product_card.css') }}">
            <!-- Propios -->
            <link rel="stylesheet" href="{{ asset('css/main.css') }}">
            <!-- Estilos para alertas js -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <x-header>
        </x-header>

        <div class="min-h-screen">
            @livewire('custom-navigation-menu')

            <!-- Page Content -->
            <main style="min-height:86vh">
              {{ $slot }}
               
            </main>
         <x-footer></x-footer>
        </div>
       
        @stack('modals')

        @livewireScripts
    </body>
</html>


<!-- Main -->
<script src="{{ asset('js/main.js') }}" defer></script>
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Product Card-->
<script src="{{ asset('js/product_card.js') }}" defer></script>
<!-- Pusher Notifications-->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<!-- Estilos para alertas js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
<!-- Push min js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" ></script>
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
      cluster: "{{env('PUSHER_APP_CLUSTER')}}" 
    });

    var channel = pusher.subscribe('ecommerce-channel');
    channel.bind('order-complete', function(data) {
        toastr.success(JSON.stringify(data.name))
    });
    
    /*Echo.channel(`ecommerce-channel`)
        .listen('order-complete', (data) => {
            console.log('Evento escuchado');
        });*/
        
</script>

{{-- 
<script>

const checkPermission = () => {
    if(!('serviceWorker' in navigator)){
        throw new Error("No support for service worker!")
    }

    if(!('Notification' in window)){
        throw new Error("No support from notification API");
    }
}

const registerSW = async () => {
    const registration = await navigator.serviceWorker.register("{{asset('js/sw.js')}}");
    return registration;
}

const requestNotificationPermission = async () => {
    const permission = await Notification.requestPermission();

    if(permission !== 'granted'){
        throw new Error("Notification permission not granted")
    }
}

const main = async () => {
    checkPermission()
    const reg = await registerSW();
    reg.showNotification("Hello Word");
}

main()

</script>
--}}


{{-- 
<script>

    // Registrar el service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("{{ asset('js/service_worker.js') }}").then((registration) => {
            console.log('Service Worker registrado con éxito');

            registration.pushManager.subscribe({ 
                userVisibleOnly: true,
                applicationServerKey: "{{env('PUSHER_APP_KEY')}}"
            })
                .then((subscription) => {
                    console.log('Usuario suscrito a las notificaciones push:', subscription);
                })
                .catch((error) => {
                    console.error('Error al suscribir al usuario a las notificaciones push:', error);
                });
        });
    }
    // Manejar el evento 'push'
    navigator.serviceWorker.addEventListener('message', (event) => {
    const data = event.data.json();
    const notificationOptions = {
        title: data.title,
    };

    self.registration.showNotification(data.title, notificationOptions);
});
  </script>
--}}