@extends('layouts.site')

@section('site_content')
    
    @if(empty($product))
        <div class="alert alert-danger"> {{ __('product.errors.none_products_founded')}} </div>
    @else
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3 text-center">
                                @if(count($productImages) == 0)
                                    @php
                                        $path = env('APP_URL') . env('APP_PUBLIC_PATH') . 'img/no-image-found.jpg';
                                    @endphp

                                    <img src="{{ $path }}" class="img w-100"></img>
                                @else 
                                    <div class="row">
                                    @foreach($productImages as $key => $productImage)
                                        @php
                                            $path = env('APP_URL') . env('APP_PUBLIC_PATH') . 'storage/' . $productImage['path'];
                                        @endphp

                                        @if($key == 0)
                                            <div class="col-12 mb-3">
                                                <img src="{{ $path }}" class="img w-100" data-fancybox="images-{{ $productImage->product_id }}" data-caption="{{ $productImage->name }} <p> {{ $productImage->description }} </p>"></img>
                                            </div>
                                        @else 
                                            <div class="col-md-4 col-lg-3 col-sm-12 mb-3">
                                                <img src="{{ $path }}" class="img" style="max-height: 100px; max-width: 100px"   data-fancybox="images-{{ $productImage->product_id }}" data-caption="{{ $productImage->name }} <p> {{ $productImage->description }} </p>"></img>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6 col-ms-12 col-md-6 mb-3">
                                
                                <h1 class="text-center">{{ $product->name }}</h1>
                                
                                <hr>

                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('category/' . $product->subcategory->category->id) }}"> {{ $product->subcategory->category->name }} </a></li>
                                        <li class="breadcrumb-item"><a href="{{ url('subcategory/' . $product->subcategory->id) }}"> {{ $product->subcategory->name }} </a> </li>
                                    </ol>
                                </nav>
                                
                                <hr>
                                {!! $product->description !!}
                                <hr>

                                <h1 class="text-center mb-3">{{ __('basic.numerals.currency_symbol') }} {{ number_format($product->price, 2, __('basic.numerals.decimal_separator'), __('basic.numerals.thousand_separator')) }}</h1>
                                
                                <hr>
                                
                                <div class="col-12 text-center">
                                    <button type="button" data-id="{{ $product->id }}" class='btn btn-lg w-100 btn-success btnAddToCart'> {{ __('basic.site.add_to_cart') }} </button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('page_js')
    <script>
        $('.btnAddToCart').on('click', function() {
            let productId = $(this).data('id');
            let products = new Array();
            
            if (localStorage.hasOwnProperty('products')) {
                products = JSON.parse(localStorage.getItem('products'));
            }

            if($.inArray(productId, products) == -1) {
                products.push(productId);
                localStorage.setItem('products', JSON.stringify(products));

                alert('produto adicionado ao carrinho');
            } else {
                localStorage.setItem('products', JSON.stringify(products));

                alert("produto já adicionado ao carrinho");
            }

            console.log("Produtos");
            console.log(products);
            activateCart();
        });
    </script>
@endsection