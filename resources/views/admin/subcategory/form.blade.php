@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/subcategory') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('subcategory.commons.name') }}</a>
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
                <form action="{{ url('admin/subcategory/save') }}@if(isset($subcategory))/{{ $subcategory->id }}@endif" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{ __('basic.form.create') }} {{ __('subcategory.commons.name') }}
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label> {{ __('category.commons.name') }} </label>
                                @if(count($categories) == 0)
                                    <div class="alert alert-danger"> {{ __('subcategory.errors.theres_no_categories_recorded')}} </div>
                                @else
                                    <select name="category_id" class="form-control select2"> 
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <div class="form-group">
                                <label> {{ __('subcategory.form.name') }} </label>
                                <input type="text" name="name" class="form-control" max-length="250" value="@if(isset($subcategory)){{ $subcategory->name }}@else{{ old('name') }}@endif"></input>
                            </div>

                            <div class="form-group">
                                <label> {{ __('subcategory.form.description') }} </label>
                                <textarea name="description" class='form-control summernote'>@if(isset($subcategory)){!! $subcategory->description !!}@else{{ old('name') }}@endif</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn @if(isset($category)) btn-warning @else btn-success @endif"> @if(isset($subcategory)){{ __('basic.form.update') }}@else{{ __('basic.form.create') }}@endif {{ __('subcategory.commons.subcategory') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection