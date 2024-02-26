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
                                        <input class="form-check-input" type="checkbox" value="{{$size->id}}" id="{{$size->id}}" name="sizes[]">
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
                                        <input class="form-check-input" type="checkbox" value="{{$color->id}}" id="{{$color->id}}" name="colors[]">
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
    var uploadUrl = "{{ route('api.upload_image') }}";

    // Se Inicializa Dropzone en el elemento con ID "my-dropzone"
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
      url: uploadUrl, // URL a la que se enviarán los archivos
      autoProcessQueue: false, // Deshabilita la carga automática de archivos
      maxFilesize: 5, // Tamaño máximo del archivo en MB
      acceptedFiles: ".jpg,.png,.gif", // Tipos de archivos permitidos
      dictDefaultMessage: "Arrastra y suelta archivos aquí o haz clic para seleccionarlos", // Mensaje predeterminado
      createImageThumbnails: true,
      addRemoveLinks: true,
      // Otros ajustes pueden seguirse agregando...
    });
    
/*
    // Evento que se dispara cuando se agregan archivos a la cola
    myDropzone.on("addedfile", function(file) {
      console.log("Archivo añadido: " + file.name);
      // Agregar botón de eliminación para cada archivo
      var removeButton = Dropzone.createElement("<button class='btn btn-danger btn-sm'>Eliminar</button>");
      var _this = this;
      removeButton.addEventListener("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        // Eliminar el archivo de Dropzone
        _this.removeFile(file);
      });
      file.previewElement.appendChild(removeButton);
    });
*/

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

    // Evento que se dispara cuando se completa la carga y procesamiento de la imagen
    myDropzone.on("success", function(file, response) {
      console.log("Imagen enviada con éxito:", response);
    });

    // Evento que se dispara cuando hay un error al procesar la imagen
    myDropzone.on("error", function(file, errorMessage, xhr) {
      console.error("Error al enviar la imagen:", errorMessage);
    });

    // Evento de clic en el botón "Enviar archivos"
    document.getElementById("saveProduct").addEventListener("click", function() {
        // Procesa la cola de Dropzone, enviando los archivos al servidor
      myDropzone.processQueue();
    });

    </script>

    @stop
</div>
