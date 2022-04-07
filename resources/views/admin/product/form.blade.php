@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/product') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('product.commons.name') }} </a>
            </div>

            <div class='col-12 mb-3'>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('admin/product/save') }}@if(isset($product))/{{ $product->id }}@endif" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{ __('product.commons.new_product') }}
                        </div>

                        <div class="card-body">
                            <div class='row m-0'>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label> {{ __('subcategory.commons.name') }} </label>
                                        @if(count($subcategories) == 0)
                                            <div class="alert alert-danger"> {{ __('subcategory.errors.theres_no_categories_recorded')}} </div>
                                        @else
                                            <select name="sub_category_id" class="form-control select2" required> 
                                                @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" @if(isset($product) && $product->sub_category_id == $subcategory->id) selected @endif> {{ $subcategory->name }} </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> {{ __('product.form.name') }} </label>
                                        <input placeholder="" required type="text" name="name" class="form-control" max-length="250" value="@if(isset($product)){{ $product->name }}@else{{ old('name') }}@endif"></input>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> {{ __('product.form.nickname') }} </label>
                                        <input type="text" name="nickname" class="form-control" max-length="250" value="@if(isset($product)){{ $product->nickname }}@else{{ old('nickname') }}@endif"></input>
                                    </div>

                                    <div class="form-group">
                                        <label> {{ __('product.form.isbn') }} </label>
                                        <input type="text" name="isbn" class="form-control" max-length="100" value="@if(isset($product)){{ $product->isbn }}@else{{ old('isbn') }}@endif"></input>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> {{ __('product.form.codebar') }} </label>
                                        <input type="text" name="codebar" class="form-control" max-length="100" value="@if(isset($product)){{ $product->codebar }}@else{{ old('codebar') }}@endif"></input>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label> {{ __('product.form.description') }} </label>
                                        <textarea name="description" row='10' class='form-control summernote'>@if(isset($product)){!! $product->description !!}@else{{ old('name') }}@endif</textarea>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label> {{ __('product.form.weight') }} ({{ __('basic.helper.grams_short') }})  </label>
                                                <input pattern="[0-9]{1,12}" placeholder="00000" type="text" name="weight" class="form-control" max-length="13" value="@if(isset($product)){{ $product->weight }}@else{{ old('weight') }}@endif"></input>
                                            </div>

                                            <div class="form-group">
                                                <label> {{ __('product.form.width') }} ({{ __('basic.helper.centimeters_short') }}) </label>
                                                <input pattern="[0-9]{1,12}"  placeholder="00000" type="text" name="width" class="form-control" max-length="13" value="@if(isset($product)){{ $product->width }}@else{{ old('width') }}@endif"></input>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label> {{ __('product.form.height') }} ({{ __('basic.helper.centimeters_short') }}) </label>
                                                <input pattern="[0-9]{1,12}"  placeholder="00000" type="text" name="height" class="form-control" max-length="13" value="@if(isset($product)){{ $product->height }}@else{{ old('height') }}@endif"></input>
                                            </div>

                                            <div class="form-group">
                                                <label> {{ __('product.form.depth') }} ({{ __('basic.helper.centimeters_short') }}) </label>
                                                <input pattern="[0-9]{1,12}" placeholder="00000" type="text" name="depth" class="form-control" max-length="13" value="@if(isset($product)){{ $product->depth }}@else{{ old('depth') }}@endif"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label> {{ __('product.form.price') }} </label>
                                    <input pattern="[0-9]{1,12}{{ __('basic.configuration.decimal_signal') }}[0-9]{2}" placeholder="0000{{ __('basic.configuration.decimal_signal') }}00" type="text" name="price" class="form-control" max-length="13" value="@if(isset($product)){{ $product->price }}@else{{ old('price') }}@endif"></input>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn @if(isset($product)) btn-warning @else btn-success @endif"> @if(isset($product)){{ __('basic.form.update') }}@else{{ __('basic.form.create') }}@endif {{ __('product.commons.name') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($product))
            <form action="{{ url('admin/product-image/save/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        {{ __('product_image.commons.product_image')}}
                    </div>

                    <div class="card-body">
                        <div class='row m-0'>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label> Nova imagem </label>
                                    <input type="file" class="form-control" name="productImage"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> {{ __('basic.form.update') }} {{ __('product_image.commons.name') }}</button>
                    </div>
                </div>
            </form>

            @if(count($productImages) > 0)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($productImages as $productImage)
                            @php
                                $path = env('APP_URL') . env('APP_PUBLIC_PATH') . '/storage/' . $productImage['path'];
                            @endphp
                            <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                <img class='w-100 img' src="{{ $path }}"> </img>
                            </div>        
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>
@endsection