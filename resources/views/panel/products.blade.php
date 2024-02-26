<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form id="my-form"> {{-- action="{{route('panel.save_product')}}" method="post" --}}
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
                            <input type="number" class="form-control" id="price" name="price" required>
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
                                        <input class="form-check-input" type="radio" value="{{$gender->id}}" id="gender" name="gender">
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
                {{-- Drag & Drop --}}

                <div id="my-dropzone" class="dropzone col mt-3 mb-3">
                    <div class="dz-message" data-dz-message><span>Arrastra y suelta archivos aquí o haz clic para seleccionarlos</span></div>
                </div>

                <button id="saveProduct" type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar</button>

            </form>
        </div>
    </div>
    @stop
    
    @section('css')        
        @livewireStyles
        <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
        <!-- Drag & Drop -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
        <link rel="stylesheet" href="{{ asset('css/draganddrop.css') }}">
    @stop
    
    @section('js')      
 
        <!-- Drag & Drop -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

  <!-- Script para inicializar Dropzone -->
    <script>

    //Guardamos ruta de envió en variable uploadUrl
    var uploadUrl = "{{ route('panel.save_product') }}";
        
    // Se Inicializa Dropzone en el elemento con ID "my-dropzone"
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
      url: uploadUrl, // URL a la que se enviarán los archivos
      autoProcessQueue: false, // Deshabilita la carga automática de archivos para que solo se envíe todo mas tarde al hacer click en el boton guardar.
      maxFilesize: 5, // Tamaño máximo del archivo en MB
      acceptedFiles: ".jpg,.png,.gif", // Tipos de archivos permitidos
      dictDefaultMessage: "Arrastra y suelta archivos aquí o haz clic para seleccionarlos", // Mensaje predeterminado
      createImageThumbnails: true,
      addRemoveLinks: true,
      // Otros ajustes pueden seguirse agregando...
    });

    // Evento que se dispara cuando se completa la carga de todos los archivos
    myDropzone.on("complete", function(file) {
      console.log("Carga completa: " + file.name);
    });

    // Agrega un evento de clic personalizado a las imágenes dentro de Dropzone
    myDropzone.on("addedfile", function(file) {
      var _this = this;
      file.previewElement.addEventListener("click", function() {
        _this.removeFile(file);
      });
           
    });
   
    // Evento que se ejecuta antes de enviar los archivos
    //Drop zone envia la peticion solo no hace falta crearla manualmente con ajax, le podemos indicar otros datos también para que envíe:
    myDropzone.on("sending", function(file, xhr, formData) {
        // Obtenemos datos del formulario ademas de las imagenes
        var productName = $("#name").val();
        var productDescription = $("#description").val();
        var productCategory = $("#category").val();
        var productSubCategory = $("#subcategory").val();
        var productGender = $("#gender").val();
        var productPrice = $("#price").val();
        var productStock = $("#stock").val();
        // Obtener los valores seleccionados de los checkboxes de color
        var productColor = [];
        $('input[id="color"]:checked').each(function() {
            productColor.push($(this).val());
        });
        var productSize = [];
        $('input[id="size"]:checked').each(function() {
            productSize.push($(this).val());
        });

        // Los agregamos al formData
        formData.append('name', productName);
        formData.append('description', productDescription);
        formData.append('price', productPrice);
        formData.append('category', productCategory);
        formData.append('subcategory', productSubCategory);
        formData.append('gender', productGender);
        formData.append('stock', productStock);
        for (var i = 0; i < productSize.length; i++) {
            formData.append('sizes[]', productSize[i]);
        }
        for (var i = 0; i < productColor.length; i++) {
            formData.append('colors[]', productColor[i]);
        }
        //log test
        formData.forEach(function(value, key){
            if(Array.isArray(value)){
                console.log(key + ': ' + value.join(', '));
            } else {
                console.log(key + ': ' + value);
            }
        });
    });

    // Evento que se dispara cuando se completa la carga y procesamiento de la imagen
    myDropzone.on("success", function(file, response) {
      console.log("Imagen enviada con éxito:", response);
    });

    // Evento que se dispara cuando hay un error al procesar la imagen
    myDropzone.on("error", function(file, errorMessage, xhr) {
      console.error("Error al enviar la imagen:", errorMessage);
    });

    // Evento de clic en el botón "Guardar"
    $("#saveProduct").click(function() {

        event.preventDefault();

        // Procesa la cola de Dropzone, enviando los archivos al servidor junto con la data adicional del formulario.
        myDropzone.processQueue();

    });

    </script>

    @stop
</div>
