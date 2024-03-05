<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form id="my-form" action="{{route('panel.delete_product')}}" method="post">
                @csrf

                {{-- Select para elegir cual es el producto que se desea editar --}}

                <div class="form-group">
                    <label for="products">Elige el producto a editar</label>
                    @if($categories !== null)
                        <select type="text" class="form-control" id="product" name="product" required>
                            <option value="">Selecciona una opción...</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}" id="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    @else 
                        <p>No hay productos cargados</p>
                    @endif  
                </div>

                </br>

                {{-- Datos del producto a editar --}}

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
                            <input type="number" class="form-control" id="price" name="price" required>
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
                                        <input class="form-check-input" type="checkbox" value="{{$size->id}}" id="size" name="sizes[]">
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
                                        <input class="form-check-input" type="checkbox" value="{{$color->id}}" id="color" name="colors[]">
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
                                        <input class="form-check-input" type="checkbox" value="{{$gender->id}}" id="gender" name="genders[]">
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

                <button id="deleteProduct" type="submit" class="btn btn-danger mt-3" style="width: 100%">Eliminar Producto</button>

            </form>
        </div>
    </div>
</div>

    @stop
    
    @section('css')        
        @livewireStyles
        <!-- Estilos para alertas js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stop
    

    @section('js')      

    <!-- toasts js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>


    <!-- Traer datos del producto -->
    <script>

        // Referencia del elemento select
        var selectedProduct = document.getElementById("product");

        // url para obtener datos producto
        var findProductUrl = "{{ route('panel.find_product') }}";

        // Agrego listener para el evento 'change'
        selectedProduct.addEventListener("change", function(event) {

        var selectedValue = event.target.value;
        
        // Verificar si se seleccionó una opción
        if (selectedValue !== "") {
            console.log("El usuario seleccionó la opción:", selectedValue);
            // Petición para obtener los datos del producto
            $.ajax({
                url: findProductUrl,
                type: 'POST', 
                data: { product: selectedValue }, 
                success: function(response) {
                    console.log(response);
                    //Resetea el form antes de agregar los datos del producto, esto sirve para foreach de los checkbox para que no se acumulen los de un producto con los de otro.
                    $('#my-form')[0].reset();
                    $('#product').val(response.id);
                    // Actualizo los valores del formulario con los datos recibidos
                    $('#name').val(response.name);
                    $('#description').val(response.description);
                    $('#price').val(response.price);
                    $('#category').val(response.category.id);
                    $('#subcategory').val(response.subcategory.id);
                    $('#gender[value="'+response.gender_id+'"]').prop('checked', true);
                    response.sizes.forEach(function(size) {
                        console.log(size.id);
                    // Marcar el/los checkbox correspondiente
                        $('#size[value="'+size.id+'"]').prop('checked', true);
                    });
                    response.colors.forEach(function(color) {
                    // Marcar el/los checkbox correspondiente
                        $('#color[value="'+color.id+'"]').prop('checked', true);
                    });

                },
                error: function(xhr, status, error) {
                    console.error('Error en la petición Ajax: ' + error);
                    // Manejar el error si ocurre
                }
            });
        } else {
            $('#my-form')[0].reset();
        }
        });
    </script>


    @stop
