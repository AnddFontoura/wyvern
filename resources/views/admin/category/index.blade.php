@extends('layouts.adminlte')

@section('adminlte_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3 text-right">
            <a href="{{ url('admin/category/create') }}" class="btn btn-success"> {{ __('basic.form.create') }} {{ __('category.commons.name') }} </a>
        </div>
    </div>

    <form action="{{ url('admin/category') }}" method="GET">
        <div class="card">
            <div class="card-header">
                {{ __('basic.form.filters') }}
            </div>

            <div class="card-body">
                <div class='row'>
                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.parameters.list.id') }} </label>
                        <input type="number" name="categoryId" class='form-control' value="@if(request()->get('categoryId') != ''){{ request()->get('categoryId') }}@endif"> </input>
                    </div>

                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('category.form.name') }} </label>
                        <input type="text" name="categoryName" class='form-control' value="@if(request()->get('categoryName') != ''){{ request()->get('categoryName') }}@endif"> </input>
                    </div>

                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.form.order-by') }} </label>
                        <select name="orderByFieldName" class='form-control'>
                            <option value='id' @if(request()->get('orderByFieldName') == 'id') selected @endif> {{ __('basic.parameters.list.id') }} </option>
                            <option value='name' @if(request()->get('orderByFieldName') == 'name') selected @endif> {{ __('basic.parameters.list.name') }} </option>
                        </select>
                    </div>

                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.form.order-by') }} </label>
                        <select name="orderByMethod" class='form-control'>
                            <option value='asc' @if(request()->get('orderByMethod') == 'asc') selected @endif> {{ __('basic.form.asc') }} </option>
                            <option value='desc' @if(request()->get('orderByMethod') == 'desc') selected @endif> {{ __('basic.form.desc') }} </option>
                        </select>
                    </div>
                    
                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.parameters.list.with_deleted') }} </label>
                        <input type="checkbox" name="withDeleted" class='form-control' @if(request()->get('withDeleted') == 'on') checked @endif> </input>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success"> {{ __('basic.form.filter_registers') }} </button>
                <a href="{{ url('admin/category') }}" class="btn btn-secondary"> {{ __('basic.form.clear-filters') }} </a>
            </div>
        </div>
    </form>

    <div class='card'>
        <div class='card-header'>
            {{ __('category.commons.name_plural') }}
        </div>

        <div class='card-body'>
            @if(count($categories) == 0)
            <div class='alert alert-danger'>
                {{ __('basic.category.none_categories_founded') }}
            </div>
            @else
            <table class='table'>
                <thead>
                    <th> {{ __('basic.parameters.list.id') }} </th>
                    <th> {{ __('basic.parameters.list.name') }} </th>
                    <th> {{ __('basic.parameters.list.created_at') }} </th>
                    <th> {{ __('basic.parameters.list.updated_at') }} </th>
                    @if(request()->get('withDeleted') == 'on') 
                        <th> {{ __('basic.parameters.list.status') }} </th>
                    @endif
                    <th class="text-right"> {{ __('basic.parameters.list.options') }}
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td> {{ $category->id }} </td>
                        <td> {{ $category->name }} </td>
                        <td> {{ $category->created_at->format(__('configuration.date_format')) }} </td>
                        <td> {{ $category->updated_at->format(__('configuration.date_format')) }} </td>
                        @if(request()->get('withDeleted') == 'on') 
                            <th> 
                                @if($category->deleted_at != null)
                                    <div class='btn btn-sm btn-danger w-100'> {{ __('basic.parameters.list.deleted')}} </div>
                                @else
                                    <div class='btn btn-sm btn-success w-100'> {{ __('basic.parameters.list.active')}} </div>
                                @endif
                            </th>
                        @endif
                        <td class='text-right'>
                            <a href="{{ url('admin/category/create/' . $category->id) }}" class="btn btn-sm btn-primary" title="{{ __('basic.form.edit') }}"> <i class="far fa-edit"></i> </a>
                            <a href="{{ url('admin/category/view/' . $category->id) }}" class="btn btn-sm btn-secondary" title="{{ __('basic.form.view') }}"> <i class="far fa-eye"></i> </a>
                            <button class="btn btn-sm btn-danger btnDelete" title="{{ __('basic.form.delete') }}" data-id="{{ $category->id }}"> <i class="far fa-trash-alt"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class='card-footer'>
            {{ $categories->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $('.btnDelete').on('click', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: '{{ __("basic.alert.attention") }}!',
            text: '{{ __("basic.alert.about_to_delete_category") }}',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("basic.alert.yes_continue") }}'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var request = $.ajax({
                    url: "{{ url('admin/category/delete') }}",
                    method: "DELETE",
                    data: {
                        id: id
                    },
                    dataType: "json"
                });

                request.done(function() {
                    Swal.fire({
                            title: '{{ __("basic.alert.done") }}',
                            text: '{{ __("basic.alert.category_deleted") }}',
                            type: 'success',
                            buttons: true,
                        })
                        .then((buttonClick) => {
                            if (buttonClick) {
                                location.reload();
                            }
                        });
                });

                request.fail(function() {
                    Swal.fire(
                        '{{ __("basic.alert.error") }}',
                        '{{ __("basic.alert.connection_error") }}',
                        'error'
                    )
                });
            } else if (result.dismiss === 'cancel') {
                Swal.fire(
                    '{{ __("basic.canceled_operation") }}',
                    '{{ __("basic.no_alteration_has_been_made") }}',
                    'error'
                )
            }
        });
    });
</script>
@endsection
