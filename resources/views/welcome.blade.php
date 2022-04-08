@extends('layouts.site')

@section('site_content')
    
    @if(count($products) == 0)
        <div class="alert alert-danger"> {{ __('product.errors.none_products_founded')}} </div>
    @else
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-12 col-lg-3 mb-3">
                <div class="card shadow-sm h-100">
                    @php
                        $productImage = Helper::getOneImageForProduct($product->id);

                        if($productImage) {
                            $path = env('APP_URL') . env('APP_PUBLIC_PATH') . 'storage/' . $productImage['path']; 
                        } else {
                            $path = env('APP_URL') . env('APP_PUBLIC_PATH') . 'img/no-image-found.jpg'; 
                        }
                    @endphp
                    <div style="background-image: url('{{ $path }}'); background-position: center; background-repeat: no-repeat; height: 200px;">
                        
                    </div>

                    <div class="card-body">
                        <p class="card-text text-center">{{ $product->name }}</p>
                        <div class="row">
                            <div class="col-12 btn-group mb-3" style='height: 70px;'>
                                <a href="{{ url('category/' . $product->subcategory->category->id) }}" class="btn btn-sm btn-outline-secondary w-50"> {{ $product->subcategory->category->name }}</a>
                                <a href="{{ url('subcategory/' . $product->subcategory->id) }}" class="btn btn-sm btn-outline-secondary w-50"> {{ $product->subcategory->name }}</a>
                            </div>
                            
                            <div class="col-12 text-center mb-3">
                                <small class="text-muted">{{ __('basic.numerals.currency_symbol') }} {{ number_format($product->price, 2, __('basic.numerals.decimal_separator'), __('basic.numerals.thousand_separator')) }}</small>
                            </div>
                            
                            <div class="col-12 text-center">
                                <a href="{{ url('product/' . $product->id) }}" class='btn btn-lg w-100 btn-success'> {{ __('basic.site.purchase') }} </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

@endsection
