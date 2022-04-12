@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/product/create/'.$product->id) }}" class="btn btn-success"> {{ __('basic.form.edit') }} {{ __('product.commons.name') }} </a>
                <a href="{{ url('admin/product') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('product.commons.name') }} </a>
            </div>
        </div>

        <div class='col-12 mb-3'>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label> {{ __('category.commons.name') }} </label>
                        <p> {{ $product->name }} <p>
                    </div>

                    <div class="form-group">
                        <label> {{ __('category.form.description') }} </label>
                        <p> {!! $product->description !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection