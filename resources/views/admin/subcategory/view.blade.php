@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/subcategory/create/'.$subcategory->id) }}" class="btn btn-success"> {{ __('basic.form.edit') }} {{ __('subcategory.commons.name') }} </a>
                <a href="{{ url('admin/subcategory') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('subcategory.commons.name') }} </a>
            </div>
        </div>

        <div class='col-12 mb-3'>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label> {{ __('category.form.name') }} </label>
                        <p> {{ $subcategory->category->name ?? null }} <p>
                    </div>

                    <div class="form-group">
                        <label> {{ __('subcategory.form.name') }} </label>
                        <p> {{ $subcategory->name }} <p>
                    </div>

                    <div class="form-group">
                        <label> {{ __('subcategory.form.description') }} </label>
                        <p> {!! $subcategory->description !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection