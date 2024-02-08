<div>
    @extends('adminlte::page')

    @section('title', 'Dashboard')
    
    @section('content_header')
        <h1>Dashboard</h1>
    @stop
    
    @section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 mr-4"> <!-- Dos columnas en monitores -->
            <form action="{{ route('index') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col">
                        <div class="form-group">
                            <label for="nombre">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen del Producto</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" required>
                        </div>

                        <div class="form-group">
                            <label for="subcategoria">Subcategoría</label>
                            <input type="text" class="form-control" id="subcategoria" name="subcategoria" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-lg-6 col-md-8 ml-4"> <!-- Dos columnas en monitores -->
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Talles</label>
                            <div class="d-flex">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="S" id="talle_s" name="talles[]">
                                    <label class="form-check-label" for="talle_s">S</label>
                                </div>
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="M" id="talle_m" name="talles[]">
                                    <label class="form-check-label" for="talle_m">M</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="L" id="talle_l" name="talles[]">
                                    <label class="form-check-label" for="talle_l">L</label>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label>Colores</label>
                            <div class="d-flex">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="Rojo" id="color_rojo" name="colores[]">
                                    <label class="form-check-label" for="color_rojo">Rojo</label>
                                </div>
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="Azul" id="color_azul" name="colores[]">
                                    <label class="form-check-label" for="color_azul">Azul</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Verde" id="color_verde" name="colores[]">
                                    <label class="form-check-label" for="color_verde">Verde</label>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label>Género</label>
                            <div class="d-flex">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="Hombre" id="genero_hombre" name="genero[]">
                                    <label class="form-check-label" for="genero_hombre">Hombre</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Mujer" id="genero_mujer" name="genero[]">
                                    <label class="form-check-label" for="genero_mujer">Mujer</label>
                                </div>
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
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
    
    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
</div>
