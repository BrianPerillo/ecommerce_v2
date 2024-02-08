<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form action="{{route('panel.save_category')}}" method="post">
                @csrf
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col">

                        <div class="form-group">
                            <label for="category">Categorías Actuales</label>
                            @if($categories !== null)
                                <select type="text" class="form-control" id="category" name="category" required>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" id="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            @else 
                                <p>No hay categorias cargadas</p>
                            @endif  
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre Categoría</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Crear Categoría</button>
            </form>
        </div>
    </div>
    @stop
    
    @section('css')        
        @livewireStyles
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
    
    @section('js')      
        @livewireScripts
    @stop
</div>
