@extends('layouts.admin')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css" rel="stylesheet">

@endsection

@section('content')

    <h1>Media Upload</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'PhotoController@store', 'class' => 'dropzone']) !!}


    {!! Form::close() !!}

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>

@endsection