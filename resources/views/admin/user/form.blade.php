@extends('layouts.adminlte')

@section('adminlte_content')
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 text-right mb-3'>
                <a href="{{ url('admin/user') }}" class="btn btn-primary"> {{ __('basic.form.list') }} {{ __('user.commons.name') }} </a>
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
                <form action="{{ url('admin/user/save') }}@if(isset($user))/{{ $user->id }}@endif" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{ __('user.commons.new_user') }}
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label> {{ __('user.form.name') }} </label>
                                <input type="text" name="name" class="form-control" max-length="250" value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif"></input>
                            </div>

                            <div class="form-group">
                                <label> {{ __('user.form.email') }} </label>
                                <input type="email" name="email" class="form-control" max-length="250" value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif"></input>
                            </div>

                            <div class="form-group">
                                <label> {{ __('user.form.password') }} </label>
                                <input type="password" name="password" class="form-control" max-length="250"></input>
                            </div>

                            <div class="form-group">
                                <label> {{ __('user.form.confirm_password') }} </label>
                                <input type="password" name="passwordConfirm" class="form-control" max-length="250"></input>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn @if(isset($user)) btn-warning @else btn-success @endif"> @if(isset($user)){{ __('basic.form.update') }}@else{{ __('basic.form.create') }}@endif {{ __('user.commons.name') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection