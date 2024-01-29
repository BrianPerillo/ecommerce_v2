@php $products = $attributes['products'] @endphp

<div>
              <!-- Products Card - DESTACADOS -->
              
                {{-- <h1>Stunning Product Carousel Example</h1> --}}
                <div class="row">
                  <div class="col-md-12">
                    <div class="slidercard ml-lg-5 ml-md-5 mt-5 py-lg-5">
                      <div class="row">
                        <div class="col-md-4">
                          <div
                            class="imgContainer ml-lg-n5 mt-lg-0 mt-md-0 ml-md-n5 mt-n5"
                          >
                          @foreach($products as $product)
                            <div class="image">
                              <img src="{{$product->photo}}" />
                            </div>
                          @endforeach
                          </div>
                        </div>
                        <div class="col-md-8">
                          <!-- slider -->
                          <div
                            id="productSlider"
                            class="carousel slide carousel-fade pr-lg-5 py-lg-0 py-4"
                            data-ride="carousel"
                            style="width:100%"
                          >
                            <div class="carousel-inner">
                              @php $contador=0 @endphp
                              @foreach($products as $product)
  
                              @if($contador==0)
                                <div class="carousel-item active">
                              @else
                                <div class="carousel-item">
                              @endif
                                  <div class="content">
                                    <div class="date" style="font-size:15px; color:rgb(255, 51, 0)">
                                       <strong> Producto Destacado </strong>
                                    </div>
                                    <div class="title">
                                      {{$product->name}}
                                    </div>
                                    <div class="desc">
                                      Lorem ipsum dolor sit amet consectetur adipisicing
                                      elit. Error itaque, libero dignissimos nihil aliquam
                                      eveniet tenetur cupiditate consectetur quod modi
                                      repellendus veniam, repellat iusto fugiat temporibus
                                      officia facere nulla nam.
                                    </div>
                                    <div class="d-flex justify-content-center justify-content-lg-start">
                                      <a class="btn readMoreBtn" href="{{route('productos.show', [$product->category, $product])}}">
                                        Ver Producto
                                      </a> 
                                    </div>
                                  </div>
                                </div>
                                @php $contador=$contador+1 @endphp
                              @endforeach                
                            </div>
  
                            <!-- indicators -->
                            <ol class="carousel-indicators indicators">
                              <li
                                data-target="#productSlider"
                                data-slide-to="0"
                                class="active"
                              ></li>
                              <li data-target="#productSlider" data-slide-to="1"></li>
                              <li data-target="#productSlider" data-slide-to="2"></li>
                            </ol>
                            <!-- indicators -->
                          </div>
                          <!-- slider -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
</div>