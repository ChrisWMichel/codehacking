@extends('layouts.admin')


@section('content')


    <h1>Create Categories</h1>
    <div class="col-sm-6">

        @include('layouts.errorList')

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
        {{csrf_field()}}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}<br>
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
        </div>


        {!! Form::close() !!}

    </div>

    <div class="col-sm-6">
        <h1>All Categories</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{route('categories.edit', $category->id)}}" >{{$category->name}}</a></td>
                    <td>{{$category->created_at->toFormattedDateString()}}</td>
                    <td>{{$category->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection