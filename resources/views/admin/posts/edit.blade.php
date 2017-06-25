@extends('layouts.admin')

@section('content')

    <h1>Edit Posts</h1>

    <div class="alert">
        <h3> @include('flash::message')</h3>
    </div>

    @include('includes.tinyeditor')
    @include('layouts.errorList')

    <div class="col-sm-3">
        <img height="100" src="{{$post->photo ? $post->photo->path : 'http://placehold.it/200x200'}}" class="img-responsive img-rounded">
    </div>
    <div class="col-sm-9">
    {!! Form::model($post, ['method'=>'Patch', 'action'=>['AdminPostsController@update', $post->id], 'files'=>TRUE]) !!}

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id',$category, NULL, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', $post->title, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}<br>
            {!! Form::textarea('body', $post->body, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Add Photo:') !!}
            {!! Form::file('photo_id', ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-info col-sm-6']) !!}
        </div>

        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger col-sm-6' ]) !!}
        {!! Form::close() !!}
    </div>
@endsection