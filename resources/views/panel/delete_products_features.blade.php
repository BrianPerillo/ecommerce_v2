<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form id="my-form" action="{{route('panel.delete_feature')}}" method="post">
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
                                        <input type="hidden" value="subcategory" name="feature">
                                    </div>

                                    <button id="delete" type="submit" class="btn btn-danger mt-3" style="width: 100%">Eliminar</button>

                                    <div class="alert alert-warning mt-4" role="alert" style="background-color:rgba(240, 229, 82, 0.192)">
                                        <h4 class="alert-heading" style="color:rgb(243, 169, 57)"><span style="font-size: 23px; position:relative; bottom:5px;margin-right:10px">⚠</span>Advertencia</h4>
                                        <p style="color:rgb(104, 104, 104)">Al eliminar una subcategoría se eliminarán los productos que estén asociados a la subcategoría. La categoría a la que pertenzca seguirá existiendo pero se puede eliminar desde la sección categorias.</p>
                                        <hr>
                                        <p class="mb-0" style="color:rgb(104, 104, 104)">Si no deseas que se eliminen los productos asociados a la subcategoría entonces primero debes crear una nueva subcategoría y asociarla con los productos, luego eliminar la subcategoría.</p>
                                    </div>
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
                                        <input type="hidden" value="category" name="feature">
                                    </div>
                                    
                                    <button id="delete" type="submit" class="btn btn-danger mt-3" style="width: 100%">Eliminar</button>

                                    <div class="alert alert-warning mt-4" role="alert" style="background-color:rgba(240, 229, 82, 0.192)">
                                        <h4 class="alert-heading" style="color:rgb(243, 169, 57)"><span style="font-size: 23px; position:relative; bottom:5px;margin-right:10px">⚠</span>Advertencia</h4>
                                        <p style="color:rgb(104, 104, 104)">Al eliminar una categoría se eliminarán también los productos que se encuentren dentro de la categoría, así como también las subcategorías que tenga asociadas</p>
                                        <hr>
                                        <p class="mb-0" style="color:rgb(104, 104, 104)">Si no deseas eliminar sus productos y subcategorías asociadas primero debes crear una nueva categoría y asociarla con los productos y subcategorías que desees y luego eliminar la categoría</p>
                                    </div>
                                @else 
                                    <p>No hay categorias cargadas</p>
                                @endif 
                                
                            {{-- sizes --}}
                            @elseif(isset($sizes))
                                <label for="category">Talles Actuales</label>
                                @if($sizes !== null)
                                    <select type="text" class="form-control" id="size" name="size" required>
                                        @foreach($sizes as $size)
                                            <option value="{{$size->id}}" id="{{$size->id}}" @if(session('sizeToDelete') !== null && $size->id == session('sizeToDelete')) selected @endif>{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <input type="hidden" value="size" name="feature">
                                    </div>
                                        
                                    <button id="delete" type="submit" class="btn btn-danger mt-3" style="width: 100%">Eliminar</button>

                                    @if(session('message')!==null)
                                        <div class="alert alert-warning mt-4" role="alert" style="background-color:rgba(240, 229, 82, 0.192)">
                                            <h4 class="alert-heading" style="color:rgb(243, 169, 57)"><span style="font-size: 23px; position:relative; bottom:5px;margin-right:10px">⚠</span>Advertencia</h4>
                                            <p style="color:rgb(104, 104, 104)">{{session('message')}} Si eliminas el talle, los siguientes productos se quedarán sin talles asociados:</p>
                                            <hr>
                                            <p class="mb-0" style="color:rgb(104, 104, 104)">
                                                @if(session('products'))
                                                    @foreach(session('products') as $product)
                                                        {{$product->name . " "}}
                                                    @endforeach
                                                @endif
                                            </p>
                                            </br>
                                            <p>Si deseas continuar igual, puedes hacerlo desde el botón eliminar</p>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="true" name="confirmDelete">
                                        </div>
                                    @endif
                                   
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
                                    
                                    <button id="delete" type="submit" class="btn btn-danger mt-3" style="width: 100%">Eliminar</button>
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
                                    
                                    <button id="delete" type="submit" class="btn btn-danger mt-3" style="width: 100%">Eliminar</button>
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
