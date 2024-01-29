<x-app-layout>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">

        <div hidden class="container">
            <h1>Brian Perillo</h1>
        </div>

        <!-- Slider Styles -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
        <link href="css/slider.css" rel="stylesheet" type="text/css">
        <!-- Carousel Destacados -->
        <link rel="stylesheet" href="{{ asset('css/index_destacados.css') }}">
        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <!-- Carousel Products -->
        <link rel="stylesheet" href="{{ asset('css/products_carousel.css') }}">
        <link rel="stylesheet"  href="{{ asset('css/owlcarousel/owl.carousel.css') }}">
        <link rel="stylesheet"  href="{{ asset('css/owlcarousel/owl.theme.default.css') }}">

          
        <!-- Slider -->

        <x-slider-home>

        </x-slider-home>
        

        <!-- Productos destacados -->

          <div class="container" style="margin:150px auto">
            <x-destacados :products="$destacados">

            </x-destacados>
        </div>

        <!-- Productos -->
        
        <div class="carousel-wrap">
            <div class="owl-carousel">
                @foreach($products as $product)
                <div class="col-md-4 p-2">
                    <div class="col-md-12 p-2">
                        {{-- <div id="">                     --}}
                            <div class="product">
                                    <div class="info-large">

                                    </div>
                                    
                                    <div class="make3D">
                                        <div class="p-3 product-front">
                                            <div class="shadow"></div>
                                            <img src="{{$product->photo}}"  style="width:200px;height:200px;margin:auto;"alt="" />
                                            <div class="image_overlay"></div>
                                            {{-- <div class="add_to_cart">Add to cart</div> --}}
                                            <a href="{{route('productos.show', [$product->category, $product])}}" class="view_gallery">Ver Producto</a>
                                            <div class="stats">        	
                                                <div class="p-3 stats-container">
                                                    <span class="product_price">${{$product->price}}</span>
                                                    <span class="product_name"></span>    
                                                    <p style="width: 60%">{{$product->name}}</p>                                            
                                                    
                                                    <div class="product-options pt-2">
                                                        <strong>TALLES</strong>
                                                        <span>
                                                            @foreach ($product->sizes as $size)
                                                                {{$size->name}}
                                                            @endforeach
                                                        </span>
                                                        <strong>COLORES</strong>
                                                        <div class="colors">
                                                            @foreach ($product->colors as $color)
                                                                <div class="c float-left mr-1" style="width:14px;height:14px;background-color:{{$color->color}};border:1px solid #dbdbdb;;border-radius:15px"></div> 
                                                            @endforeach
                                                        </div>
                                                    </div>                
                                                </div>                         
                                            </div>
                                        </div>
                                        
                                        <div class="product-back">
                                            <div class="shadow"></div>
                                            <div class="carousel">
                                                <ul class="carousel-container">
                                                    <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/8.jpg" alt="" /></li>
                                                    <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" /></li>
                                                </ul>
                                                <div class="arrows-perspective">
                                                    <div class="carouselPrev">
                                                        <div class="y"></div>
                                                        <div class="x"></div>
                                                    </div>
                                                    <div class="carouselNext">
                                                        <div class="y"></div>
                                                        <div class="x"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <div class="cy"></div>
                                                <div class="cx"></div>
                                            </div>
                                        </div>	  
                                    </div>	
                                  
                            </div>
                            
                        {{-- </div> --}}
                    </div>
                </div>

                @endforeach
            </div>
          </div>        

    </div>

</x-app-layout>

    <!-- Slider Scripts -->
          
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script type="text/javascript">
            
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);
                        
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
            
    </script>

  
<script src="{{ asset('js/destacados_carousel.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/products_carousel.js') }}"></script>

