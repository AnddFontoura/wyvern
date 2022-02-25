@extends('layouts.adminlte')

@section('adminlte_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3 text-right">
            <a href="{{ url('admin/subcategory/create') }}" class="btn btn-success"> {{ __('basic.form.create') }} {{ __('subcategory.commons.name') }}</a>
        </div>
    </div>

    <form action="" method="GET">
        <div class="card">
            <div class="card-header">
                {{ __('basic.form.filters') }}
            </div>

            <div class="card-body">
                <div class='row'>
                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.parameters.list.id') }} </label>
                        <input type="number" name="subCategoryId" class='form-control'> </input>
                    </div>

                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('subcategory.commons.name') }} </label>
                        <input type="text" name="subCategoryName" class='form-control'> </input>
                    </div>

                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.form.order-by') }} </label>
                        <select name="orderByFieldName" class='form-control'>
                            <option value='id'> {{ __('basic.parameters.list.id') }} </option>
                            <option value='name'> {{ __('basic.parameters.list.name') }} </option>
                        </select>
                    </div>

                    <div class='col-md-3 col-lg-3 col-sm-12'>
                        <label> {{ __('basic.form.order-by') }} </label>
                        <select name="orderByMethod" class='form-control'>
                            <option value='asc'> {{ __('basic.form.asc') }} </option>
                            <option value='desc'> {{ __('basic.form.desc') }} </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success"> {{ __('basic.form.filter_registers') }} </button>
                <a href="{{ url('subcategory') }}" class="btn btn-secondary"> {{ __('basic.form.clear-filters') }} </a>
            </div>
        </div>
    </form>

    <div class='card'>
        <div class='card-header'>
            {{ __('subcategory.commons.name_plural') }}
        </div>

        <div class='card-body'>
            @if(count($subcategories) == 0)
            <div class='alert alert-danger'>
                {{ __('subcategory.errors.none_subcategories_founded') }}
            </div>
            @else
            <table class='table'>
                <thead>
                    <th> {{ __('basic.parameters.list.id') }} </th>
                    <th> {{ __('category.commons.name') }} </th>
                    <th> {{ __('basic.parameters.list.name') }} </th>
                    <th> {{ __('basic.parameters.list.created_at') }} </th>
                    <th> {{ __('basic.parameters.list.updated_at') }} </th>
                    <th class="text-right"> {{ __('basic.parameters.list.options') }}
                </thead>

                <tbody>
                    @foreach($subcategories as $subCategory)
                    <tr>
                        <td> {{ $subCategory->id }} </td>
                        <td> {{ $subCategory->category->name ?? null }} </td>
                        <td> {{ $subCategory->name }} </td>
                        <td> {{ $subCategory->created_at->format(__('configuration.date_format')) }} </td>
                        <td> {{ $subCategory->updated_at->format(__('configuration.date_format')) }} </td>
                        <td class='text-right'>
                            <a href="{{ url('admin/subcategory/create/' . $subCategory->id) }}" class="btn btn-sm btn-primary" title="{{ __('basic.form.edit') }}"> <i class="far fa-edit"></i> </a>
                            <a href="{{ url('admin/subcategory/view/' . $subCategory->id) }}" class="btn btn-sm btn-secondary" title="{{ __('basic.form.view') }}"> <i class="far fa-eye"></i> </a>
                            <button id='btnDelete' class="btn btn-sm btn-danger" title="{{ __('basic.form.delete') }}" data-id="{{ $subCategory->id }}"> <i class="far fa-trash-alt"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class='card-footer'>
            {{ $subcategories->links() }}
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $('#btnDelete').on('click', function() {
    var id = $(this).data('id');

    Swal.fire({
        title: '{{ __("basic.alert.attention") }}!',
        text: '{{ __("basic.alert.about_to_delete_subcategory") }}',
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
                url: "{{ url('admin/subcategory/delete') }}",
                method: "DELETE",
                data: {
                    id: id
                },
                dataType: "json"
            });

            request.done(function() {
                Swal.fire({
                        title: '{{ __("basic.alert.done") }}',
                        text: '{{ __("basic.alert.subcategory_deleted") }}',
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
