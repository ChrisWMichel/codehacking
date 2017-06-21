@extends('layouts.admin')

@section('content')

    <h1>Create Posts</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store',  'files'=>true]) !!}
    {{csrf_field()}}

    <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}<br>
            {!! Form::select('category_id',  $category, null, ['placeholder'=> 'Choose Category:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}<br>
            {!! Form::text('title', NULL) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Content:') !!}<br>
            {!! Form::textarea('body', NULL) !!}
        </div>

        <div class="form-group">
            {!! Form::file('photo_id') !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>


    {!! Form::close() !!}

@endsection