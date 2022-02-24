@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/category') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('category.commons.name') }} </a>
            </div>

            <div class='col-12 mb-3'>
                <form action="{{ url('admin/category/save') }}@if(isset($category))/{{ $category->id }}@endif" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{ __('category.commons.new_category') }}
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label> {{ __('category.form.name') }} </label>
                                <input type="text" name="name" class="form-control" max-length="250" value="@if(isset($category)){{ $category->name }}@else{{ old('name') }}@endif"></input>
                            </div>

                            <div class="form-group">
                                <label> {{ __('category.form.description') }} </label>
                                <textarea name="description" class='form-control summernote'>@if(isset($category)){!! $category->description !!}@else{{ old('name') }}@endif</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn @if(isset($category)) btn-warning @else btn-success @endif"> @if(isset($category)){{ __('basic.form.update') }}@else{{ __('basic.form.create') }}@endif {{ __('category.commons.name') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection