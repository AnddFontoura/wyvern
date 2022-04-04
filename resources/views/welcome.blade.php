@extends('layouts.site')

@section('site_content')
    
    @if(count($products) == 0)
        <div class="alert alert-danger"> {{ __('product.errors.none_products_founded')}} </div>
    @else
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-12 col-lg-3 mb-3">
                <div class="card shadow-sm h-100">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                    <div class="card-body">
                        <p class="card-text text-center">{{ $product->name }}</p>
                        <div class="row">
                            <div class="col-12 btn-group mb-3" style='height: 70px;'>
                                <button type="button" class="btn btn-sm btn-outline-secondary w-50"> {{ $product->subcategory->name }}</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary w-50"> {{ $product->subcategory->category->name }}</button>
                            </div>
                            
                            <div class="col-12 text-center">
                                <small class="text-muted">{{ __('basic.numerals.currency_symbol') }} {{ number_format($product->price, 2, __('basic.numerals.decimal_separator'), __('basic.numerals.thousand_separator')) }}</small>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

@endsection
