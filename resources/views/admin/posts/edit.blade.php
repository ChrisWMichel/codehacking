@extends('layouts.admin')

@section('content')

    <h1>Edit Posts</h1>
    <img height="100" src="{{$post->photo ? $post->photo->path : 'http://placehold.it/200x200'}}" class="img-responsive img-rounded">
<br><br>
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
            {!! Form::textarea('body', $post->body) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Add Photo:') !!}
            {!! Form::file('photo_id', NULL) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
        </div>

    {!! Form::close() !!}

@endsection