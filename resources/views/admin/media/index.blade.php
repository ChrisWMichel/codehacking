@extends('layouts.admin')

@section('content')


    <h1>Media</h1>

    @if($photos)
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Path</th>
            <th>Created</th>
        </tr>
        </thead>
        <tbody>

        @foreach($photos as $photo)
        <tr>
            <td>{{$photo->id}}</td>
            <td><img height="100" src="{{$photo->path}}"></td>
            <td>{{$photo->path}}</td>
            <td>{{$photo->created_at->toFormattedDateString()}}</td>
            <td>
                {!! Form::open(['method'=>'DELETE', 'action'=>['PhotoController@destroy', $photo->id]]) !!}

                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
    @else
        <h2>There are no photos</h2>
    @endif
@endsection