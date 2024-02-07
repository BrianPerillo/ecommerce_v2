@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('index') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen del Producto</label>
                    <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
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
                    <label>Talles</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="S" id="talle_s" name="talles[]">
                        <label class="form-check-label" for="talle_s">S</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="M" id="talle_m" name="talles[]">
                        <label class="form-check-label" for="talle_m">M</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="L" id="talle_l" name="talles[]">
                        <label class="form-check-label" for="talle_l">L</label>
                    </div>
                    <!-- Agrega más talles según tus necesidades -->
                </div>

                <div class="form-group">
                    <label>Colores</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Rojo" id="color_rojo" name="colores[]">
                        <label class="form-check-label" for="color_rojo">Rojo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Azul" id="color_azul" name="colores[]">
                        <label class="form-check-label" for="color_azul">Azul</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Verde" id="color_verde" name="colores[]">
                        <label class="form-check-label" for="color_verde">Verde</label>
                    </div>
                    <!-- Agrega más colores según tus necesidades -->
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Hombre" id="genero_hombre" name="genero[]">
                        <label class="form-check-label" for="genero_hombre">Hombre</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Mujer" id="genero_mujer" name="genero[]">
                        <label class="form-check-label" for="genero_mujer">Mujer</label>
                    </div>
                    <!-- Agrega más géneros según tus necesidades -->
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
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