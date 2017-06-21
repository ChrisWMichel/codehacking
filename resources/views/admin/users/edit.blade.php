@extends('layouts.admin')


@section('content')
    <h1>Edit User</h1>
    <br>
    @include('layouts.errorList')
    <div class="col-sm-3">

      <img src="{{$user->photo ? $user->photo->path : 'http://placehold.it/400x400'}}" class="img-responsive img-rounded">

    </div>

    <div class="col-sm-9">

        {!! Form::model($user, ['method'=>'Patch', 'action'=> ['AdminUserController@update',  $user->id], 'files'=>true]) !!}
        {{csrf_field()}}

            <div class="form-group">
                {!! Form::label('role_id', 'Role:') !!}<br>
                {!! Form::select('role_id',  $roles, null, ['placeholder'=> 'Pick role:']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('status', 'Status:') !!}<br>
                {!! Form::select('status', [1 => 'Active', 0 => 'Not Active'], null, ['placeholder'=> 'choose status:']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}<br>
                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}<br>
                {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}<br>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirm', 'Password Confirm:') !!}<br>
                {!! Form::password('password_confirm', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', NULL) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User', ['class' => 'btn btn-primary col-sm-6']) !!}
            </div>

        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUserController@destroy', $user->id], 'class' => ' pull-right']) !!}

        <div class="form-group">
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@endsection