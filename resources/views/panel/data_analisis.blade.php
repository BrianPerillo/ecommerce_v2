<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
 
        </div>
    </div>
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
 
    <!-- toasts js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>


    @stop
