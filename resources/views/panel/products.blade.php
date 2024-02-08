<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form action="{{route('panel.save_product')}}" method="post">
                @csrf

                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nombre del Producto</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        {{--<div class="form-group">
                            <label for="imagen">Imagen del Producto</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                        </div>--}}

                        <div class="form-group">
                            <label for="category">Categoría</label>
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
                            <label for="subcategory">Subcategoría</label>
                            @if($subcategories !== null)
                                <select type="text" class="form-control" id="subcategory" name="subcategory" required>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" id="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                    @endforeach
                                </select>
                            @else 
                                <p>No hay subcategorias cargadas</p>
                            @endif  
                        </div>

                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-lg-6 col-md-8 ml-4"> <!-- Dos columnas en monitores -->
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Talles</label>
                            <div class="d-flex">
                                @if($sizes !== null)
                                    @foreach($sizes as $size)
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="checkbox" value="{{$size->id}}" id="{{$size->id}}" name="size[]">
                                        <label class="form-check-label" for="{{$size->id}}">{{$size->name}}</label>
                                    </div>
                                    @endforeach
                                @else 
                                    <p>No hay talles cargados</p>
                                @endif  
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label>Colores</label>
                            <div class="d-flex">
                                @if($colors !== null)
                                    @foreach($colors as $color)
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="checkbox" value="{{$color->id}}" id="{{$color->id}}" name="color[]">
                                        <label class="form-check-label" for="{{$color->id}}">{{$color->name}}</label>
                                    </div>
                                    @endforeach
                                @else 
                                    <p>No hay colores cargados</p>
                                @endif      
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label>Género</label>
                            <div class="d-flex">
                                @if($genders !== null)
                                    @foreach($genders as $gender)
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="radio" value="{{$gender->id}}" id="{{$gender->id}}" name="gender">
                                        <label class="form-check-label" for="{{$gender->id}}">{{$gender->name}}</label>
                                    </div>
                                    @endforeach
                                @else 
                                    <p>No hay generos cargados</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar</button>
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
