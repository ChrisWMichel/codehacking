@extends('layouts.admin')


@section('content')
    <h1>Create User</h1>
<br>
    @include('layouts.errorList')

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUserController@store',  'files'=>true]) !!}
    {{csrf_field()}}

    <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}<br>
            {!! Form::select('role_id',  $roles, null, ['placeholder'=> 'Pick role:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}<br>
            {!! Form::select('status', ["1" => 'Active', "0" => 'Not Active'], null, ['placeholder'=> 'choose status:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}<br>
            {!! Form::text('name', NULL) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}<br>
            {!! Form::email('email', NULL) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}<br>
            {!! Form::text('password') !!}
        </div>

        <div class="form-group">
            {!! Form::label('password_confirm', 'Password Confirm:') !!}<br>
            {!! Form::text('password_confirm') !!}
        </div>

        <div class="form-group">
            {!! Form::file('image_id') !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
        </div>


    {!! Form::close() !!}



@endsection