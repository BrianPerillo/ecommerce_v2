<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12 bg-white">

        <div class="container" style="overflow: hidden">
            <h1>{{"Carrito"}}</h1>

            @if(sizeof($cart_products)>0)

            <div class="col mb-1" style="overflow:hidden">
            
                <div class="row mr-3">
                    <div class="col">
                        <p class="text-center"></p>
                    </div>

                    <div class="col">
                        <p class="text-center">Producto</p>
                    </div>
                    
                    <div class="col">
                        <p class="text-center">Cantidad</p>
                    </div>
                    
                    <div class="col">
                        <p class="text-center">Color</p>
                    </div>
                    
                    <div class="col">
                        <p class="text-center">Talle</p>
                    </div>

                    <div class="col mr-3">
                        <p class="text-center">Total</p>
                    </div>
                    


                    <div class="" style="display:none">
                         <div class="mr-2 mt-1 mb-1">
                            <button class="btn btn-danger">
                                    <span><i class="fas fa-trash-alt"></i></span>
                             </button>
                            </div>
                        <div class="mr-2 mt-2 mb-1">
                            <button class="btn btn-primary">
                                <span class="fas fa-edit" style="font-size: 14px"></span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

            <hr>

                @foreach ($cart_products as $cart_product) 

                        <div class="col mb-1" style="overflow:hidden">

                            <div class="row">
                                <!-- Cover -->
                                    <div class="col" style="float:left;margin-right:30px">
                                        <img src="{{$cart_product->product_detail->photo}}" style="width:70px;">
                                    </div>

                                    <div class="col" style="float:left;margin-top:30px">
                                        <p>
                                            {{$cart_product->product_detail->name}}
                                        </p>
                                    </div>

                                    @if(isset($edit) && $cart_product->id==$cart_product_id)
                                    
                                    <form class="row" action="{{route('confirm_edit.carrito', $cart_product)}}" method="post" style="width:69%;margin-top:30px;border-radius:20px;">
                                        @csrf 
                                        @method('put')

                                            <div class="col">
                                                <input name="quantity" class="form-control" type="number" min="1" value="{{$cart_product->quantity}}">
                                            </div>

                                            <div class="col">
                                                <select class="form-control" name="color" id="">
                                                    <optgroup label="Color">
                                                    @foreach ($colors as $color)
                                                        <option name="color" value="{{$color->id}}" style="background-color:{{$color->color}};color:rgb(230, 230, 230);">
                                                            <p>{{$color->name}}</p>
                                                        </option>
                                                    @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                            
                                            <div class="col">
                                                    <select class="form-control" name="size" id="">
                                                        <optgroup label="Talle">
                                                        @foreach ($sizes as $size)
                                                            <option name="size" value="{{$size->id}}">
                                                                {{$size->name}}
                                                            </option>
                                                        @endforeach
                                                        </optgroup>
                                                    </select>
                                            </div>

                                            <div class="col">
                                                <p class="text-center" style="">
                                                    {{$cart_product->total_price}}
                                                </p>
                                            </div>

                                            {{-- Botones Confirmar Edición --}}
                                            <div style="width: 67px;margin-top:-30px">
                                                <div class="mr-2 mt-1 mb-1">
                                                    <button type="submit" class="btn btn-success">
                                                        <span><i class="fas fa-check-circle"></i></span>
                                                    </button>
                                                </div>
                                            
                                    </form>

                                    
                                                <div class="mr-2 mt-2 mb-1">
                                                    <form class="" action="{{route('user.cart', auth()->user())}}" method="get">
                                                    <button class="btn btn-danger">
                                                        <span><i class="fas fa-window-close"></i></span>
                                                    </button>
                                                    </form>
                                                </div>
                                            </div>

                                       

                                    @else

                                        <div class="col">
                                            <p class="text-center" style="margin-top:30px">
                                                {{$cart_product->quantity}}
                                            </p>
                                        </div>

                                        <div class="col d-flex justify-content-center">
                                            <div style="margin-top:30px;background-color:{{$cart_product->color->color}};border-radius:20px;width:22px;height:22px"></div>
                                        </div>

                                        <div class="col">
                                            <p class="text-center" style="margin-top:30px">
                                                {{$cart_product->size->name}}
                                            </p>
                                        </div>

                                        <div class="col">
                                            <p class="text-center" style="margin-top:30px">
                                                {{$cart_product->total_price}}
                                            </p>
                                        </div>

                                        <div>
                                            {{-- Botones Editar y Eliminar --}}
                                            <div class="mr-2 mt-1 mb-1">
                                                <form class="delete_product" action="{{route('delete.carrito', $cart_product)}}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <button class="btn btn-danger">
                                                        <span><i class="fas fa-trash-alt"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="mr-2 mt-2 mb-1">
                                                <form action="{{route('edit.carrito', $cart_product)}}">
                                                    <button class="btn btn-primary" type="submit">
                                                        <span class="fas fa-edit" style="font-size: 14px"></span>
                                                    </button>
                                                </form>
                                            </div>  
                                                                                      
                                        </div>
                                        
                                    @endif


                             </div>
                        </div>

                        <hr>

                @endforeach

            @else
            
            <div class="p-4">
                <p> - Aún no hay productos en el carrito </p>  
            </div>
                
            @endif

            <div class="p-2">
                {{$cart_products->links()}}
            </div>

        </div>

    </div>

</x-app-layout>

<script>

    //Script para SweetAlert Delete
    $(".delete_product").submit(function(e){
        e.preventDefault();

            Swal.fire({
                title: '¿Deseas elimnar este producto del carrito?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar del carrito!'
            }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El producto fue eliminado del carrito.',
                    'success'
                )
                this.submit();
                }
            })
        });

</script>