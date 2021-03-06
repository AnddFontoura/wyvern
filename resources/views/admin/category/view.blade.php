@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/category/create/'.$category->id) }}" class="btn btn-success"> {{ __('basic.form.edit') }} {{ __('category.commons.name') }} </a>
                <a href="{{ url('admin/category') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('category.commons.name') }} </a>
            </div>
        </div>

        <div class='col-12 mb-3'>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label> {{ __('category.commons.name') }} </label>
                        <p> {{ $category->name }} <p>
                    </div>

                    <div class="form-group">
                        <label> {{ __('category.form.description') }} </label>
                        <p> {!! $category->description !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection