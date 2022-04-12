@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/user/create/'.$user->id) }}" class="btn btn-success"> {{ __('basic.form.edit') }} {{ __('user.commons.name') }} </a>
                <a href="{{ url('admin/user') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('user.commons.name') }} </a>
            </div>
        </div>

        <div class='col-12 mb-3'>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label> {{ __('user.commons.name') }} </label>
                        <p> {{ $user->name }} <p>
                    </div>

                    <div class="form-group">
                        <label> {{ __('user.form.email') }} </label>
                        <p> {{ $user->email }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection