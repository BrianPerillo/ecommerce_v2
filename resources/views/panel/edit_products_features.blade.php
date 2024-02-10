<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form action="{{route('panel.edit_feature')}}" method="post">
                @csrf
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col">

                        <div class="form-group">
                        {{-- if elseif por cada caracteristica (categorias, subcategorias etc..) --}}
                        {{-- subcategory --}}
                            @if(isset($subcategories) && isset($subcategories))
                                <label for="subcategory">Subcategorias Actuales</label>
                                @if($subcategories !== null)
                                    <select type="text" class="form-control" id="subcategory" name="subcategory" required>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" id="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="name">Nombre Subcategoría</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <input type="hidden" value="subcategory" name="feature">
                                    </div>
                                    <label for="related_category">Categoría Relacionada</label>
                                    <select type="text" class="form-control" id="related_category" name="related_category" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" id="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar Subcategoría</button>
                                @else 
                                    <p>No hay subcategorias cargadas</p>
                                @endif  

                            {{-- category --}}
                            @elseif(isset($categories))
                                <label for="category">Categorías Actuales</label>
                                @if($categories !== null)
                                    <select type="text" class="form-control" id="category" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" id="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="name">Nombre Categoria</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <input type="hidden" value="category" name="feature">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar Categoría</button>
                                @else 
                                    <p>No hay categorias cargadas</p>
                                @endif 
                                
                            {{-- sizes --}}
                            @elseif(isset($sizes))
                                <label for="category">Talles Actuales</label>
                                @if($sizes !== null)
                                    <select type="text" class="form-control" id="size" name="size" required>
                                        @foreach($sizes as $size)
                                            <option value="{{$size->id}}" id="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="name">Nombre Talle</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <input type="hidden" value="size" name="feature">
                                    </div>
                                        
                                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar Talle</button>
                                @else 
                                    <p>No hay talles cargados</p>
                                @endif 

                            {{-- colors --}}
                            @elseif(isset($colors))
                                <label for="category">Colores Actuales</label>
                                @if($colors !== null)
                                    <select type="text" class="form-control" id="color" name="color" required>
                                        @foreach($colors as $color)
                                            <option value="{{$color->id}}" id="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="name">Nombre Color</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name">Hexadecimal Color</label>
                                        <input type="text" class="form-control" id="hexa" name="hexa" required>
                                        <input type="hidden" value="color" name="feature">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar Color</button>
                                @else 
                                    <p>No hay colores cargados</p>
                                @endif 

                            {{-- genders --}}
                            @elseif(isset($genders))
                                <label for="gender">Géneros Actuales</label>
                                @if($genders !== null)
                                    <select type="text" class="form-control" id="gender" name="gender" required>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}" id="{{$gender->id}}">{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="name">Género</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <input type="hidden" value="gender" name="feature">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar Género</button>
                                @else 
                                    <p>No hay géneros cargados</p>
                                @endif 

                            @endif 
                        </div>

                    </div>

                </div>
                
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
