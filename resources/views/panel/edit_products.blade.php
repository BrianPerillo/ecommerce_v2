<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form id="my-form"> {{-- action="{{route('panel.save_product')}}" method="post" --}}
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
                {{-- Drag & Drop --}}

                <div id="my-dropzone" class="dropzone col mt-3 mb-3">
                    <div class="dz-message" data-dz-message><span>Arrastra y suelta archivos aquí o haz clic para seleccionarlos.</span><p class="mt-2" style="font-size:15px">Tamaño Máximo: 3MB - Formatos permitidos: .jpg, .jpeg y .png</p></div>
                </div>

                <button id="saveProduct" type="submit" class="btn btn-primary mt-3" style="width: 100%">Guardar Cambios</button>

            </form>
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
 
    <!-- Drag & Drop -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <!-- toasts js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <!-- Script para detectar el producto seleccionado para editar -->
    <script>

        // Referencia del elemento select
        var selectedProduct = document.getElementById("product");

        // url para obtener datos producto
        var findProductUrl = "{{ route('panel.find_product') }}";

        //Variable para almacenar referencias a las imagenes del producto traidas en la peticion ajax para luego poder removerlas de dropzone
        var displayedFiles = [];

        //Variable para almacenar imagenes a eliminar
        var deleteImages = [];

        var productPreviousImages = [];

        // Agrego listener para el evento 'change'
        selectedProduct.addEventListener("change", function(event) {

            //Vacio deleteImages y productPreviousImages si se cambia de producto
            deleteImages = [];
            productPreviousImages = [];

            // Remover todas las referencias de imagenes mostradas previamente en la caja de dropzone
            displayedFiles.forEach(function(file) {
                myDropzone.removeFile(file);
            });

            myDropzone.removeAllFiles(true);
            // Valor seleccionado del select
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

                        response.images.forEach(function(image) {
                            Dropzone.autoDiscover = false;
                            let mockFile = { name: image.image_name}; 
                            var image_url = "{{ asset('') }}" + "storage/product_images/" + image.image_name
                            myDropzone.displayExistingFile(mockFile, image_url);
                            // Almacenar referencia al archivo mostrado en la matriz
                            displayedFiles.push(mockFile);
                            //addCustomRemoveButton(mockFile);
                            //Almaceno imagenes del producto en array para validación posterior en envio ajax: 
                            productPreviousImages.push(image.image_name);
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


        // Función para agregar un botón de eliminación personalizado a una imagen que vaya cargando el array deleteImages
        function addCustomRemoveButton(file) {
            var removeButton = Dropzone.createElement("<button class='custom-remove-button'>Eliminar</button>");
            removeButton.addEventListener("click", function(e) {
                deleteImages.push(file.name);
                console.log("deleteImages");
                console.log(deleteImages);
                this.removeFile(file);
                // Eliminar el archivo de tu registro de archivos mostrados
                removeDisplayedFile(file.name);
                e.preventDefault();
                e.stopPropagation();
            });
            // Agregar el botón de eliminación personalizado al elemento de vista previa del archivo
            file.previewElement.appendChild(removeButton);
        }

    </script>


    <!-- Script para inicializar Dropzone -->
    <script>

    //Ruta de envió en variable uploadUrl
    var uploadUrl = "{{ route('panel.edit_product') }}";
        
    // Se Inicializa Dropzone en el elemento con ID "my-dropzone"
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: uploadUrl, // URL a la que se enviarán los archivos
        autoProcessQueue: false, // Deshabilita la carga automática de archivos para que solo se envíe todo mas tarde al hacer click en el boton guardar.
        maxFilesize: 3, // Tamaño máximo del archivo en MB
        acceptedFiles: ".jpg,.jpeg,.png", // Tipos de archivos permitidos
        dictDefaultMessage: "Arrastra y suelta archivos aquí o haz clic para seleccionarlos. Tamaño Máximo: 3MB - Formatos permitidos: .jpg, .jpeg, .png", // Mensaje predeterminado
        createImageThumbnails: true,
        //addRemoveLinks: true,
        init: function() {
            this.on("error", function(file, errorMessage) {
                if (file.accepted === false) {
                    // Archivo no aceptado por tamaño o formato
                    toastr.error(JSON.stringify('No se puede cargar este tipo de archivo. Revisa el formato y tamaño'))
                    this.removeFile(file); // Eliminar el archivo de la cola
                }
            });
        }
      // Otros ajustes pueden seguirse agregando...
    });

    // Evento que se dispara cuando se completa la carga de todos los archivos
    myDropzone.on("complete", function(file) {
      console.log("Carga completa: " + file.name);
    });

    // Agrega un evento de clic personalizado a las imágenes dentro de Dropzone
    myDropzone.on("addedfile", function(file) {
      var _this = this;
      addCustomRemoveButton(file);
      file.previewElement.addEventListener("click", function() {
        _this.removeFile(file);
      });
           
    });
   
    // Evento que se ejecuta antes de enviar los archivos
    //Drop zone envia la peticion solo no hace falta crearla manualmente con ajax, le podemos indicar otros datos también para que envíe:
    myDropzone.on("sending", function(file, xhr, formData) {

        // Guardar datos checkboxes en arrays
        var productColor = [];
        $('input[id="color"]:checked').each(function() {
            productColor.push($(this).val());
        });
        var productSize = [];
        $('input[id="size"]:checked').each(function() {
            productSize.push($(this).val());
        });
        var productGenders = [];
        $('input[id="gender"]:checked').each(function() {
            productGenders.push($(this).val());
        });

        // Agregar datos del formulario al formData
        formData.append('product', $('#product').val()); //Este es el producto a editar
        formData.append('name', $("#name").val());
        formData.append('description', $("#description").val());
        formData.append('price', $("#price").val());
        formData.append('category', $("#category").val());
        formData.append('subcategory', $("#subcategory").val());
        //Acá se envian las imgs a eliminar, en caso de no haber no se envia el array directamente por que no se ejecuta el for
        for (var i = 0; i < deleteImages.length; i++) {
            formData.append('delete_images[]', deleteImages[i]);
        }
        for (var i = 0; i < productGenders.length; i++) {
            formData.append('genders[]', productGenders[i]);
        }
        for (var i = 0; i < productSize.length; i++) {
            formData.append('sizes[]', productSize[i]);
        }
        for (var i = 0; i < productColor.length; i++) {
            formData.append('colors[]', productColor[i]);
        }
        /*log test
        formData.forEach(function(value, key){
            if(Array.isArray(value)){
                console.log(key + ': ' + value.join(', '));
            } else {
                console.log(key + ': ' + value);
            }
        });*/
    });

    // Evento que se dispara cuando se completa la carga y procesamiento de la imagen
    myDropzone.on("success", function(file, response) {
        console.log("response");
        console.log("response");
        console.log("response");
        console.log(response);
        $('#my-form')[0].reset();
        this.removeFile(file);
        // Remover todas las referencias de imagenes mostradas previamente en la caja de dropzone
        displayedFiles.forEach(function(file) {
            myDropzone.removeFile(file);
        });

      toastr.success(JSON.stringify('Producto guardado correctamente'))
    });

    // Evento que se dispara cuando hay un error al procesar la imagen
    myDropzone.on("error", function(file, errorMessage, xhr) {
        console.error("Error al enviar la imagen:", errorMessage);
        // Reinicio de la cola de Dropzone para permitir el reenvío de archivos sino no se puede volver a enviar
        this.removeFile(file);
        toastr.error(JSON.stringify('Error al editar el producto. Asegurate de completar el formulario :)'))
    });

    // Iniciar processQueue
    $("#saveProduct").click(function() {

        console.log("asdfasdfasdfasdfasdfasdfasdfasfdasfdasdf");
        console.log(deleteImages.length);
        console.log(productPreviousImages.length);

        event.preventDefault();

        // Verificar si hay archivos en la cola de carga
        var queuedFiles = myDropzone.getQueuedFiles();

        //Si se cargaron archivos en Dropzone:
        if (queuedFiles.length > 0) {
            // Se procesa la cola de Dropzone para enviar los archivos al servidor
            myDropzone.processQueue();

        //Si no se cargaron imagenes en dropzone se realiza petición ajax:
        } else {
            // Dado que no se cargaron nuevas imagenes por dropzone, chequeo que existan imagenes asociadas al producto y no se hayan removido todas
            if(deleteImages.length == productPreviousImages.length){
                toastr.error(JSON.stringify('El producto no tiene imagenes asociadas. Por favor agrega alguna imagen para el producto'))
            } 
            else { // Si no quedaron imagenes asociadas porque no cargo nuevas y eliminó todas las preexistentes: 

                // Si no hay archivos en la cola se realiza una petición AJAX con los demas datos del formulario
                var formData = new FormData();

                // Se guarda data del formulario
                var productColor = [];
                $('input[id="color"]:checked').each(function() {
                    productColor.push($(this).val());
                });
                var productSize = [];
                $('input[id="size"]:checked').each(function() {
                    productSize.push($(this).val());
                });
                var productGenders = [];
                $('input[id="gender"]:checked').each(function() {
                    productGenders.push($(this).val());
                });

                // Agregamos los datos del formulario al formData
                formData.append('product', $('#product').val()); //El producto a editar
                formData.append('name', $("#name").val());
                formData.append('description', $("#description").val());
                formData.append('price', $("#price").val());
                formData.append('category', $("#category").val());
                formData.append('subcategory', $("#subcategory").val());
                for (var i = 0; i < deleteImages.length; i++) {
                    formData.append('delete_images[]', deleteImages[i]);
                }
                for (var i = 0; i < productGenders.length; i++) {
                    formData.append('genders[]', productGenders[i]);
                }
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

                //Peticion Ajax
                $.ajax({
                        url: uploadUrl,
                        type: 'POST', 
                        data: formData, 
                        processData: false,
                        contentType: false, 
                        success: function(response) {
                            toastr.success(JSON.stringify('Producto guardado correctamente'))
                            console.log(response);
                            //Se limpia delete_images:
                            deleteImages = [];
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en la petición Ajax: ' + error);
                            toastr.error(JSON.stringify('Error al editar el producto. Asegurate de completar el formulario :)'))
                        }
                    });
            }
            
            
        }




    });

    </script>

    @stop
