@extends('layouts.admin')

@section('content')

    <h1>Admin Posts</h1>

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Posts</th>
            <th>comments</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            @if($post->photo)
                <td> <img height="50" src="{{$post->photo->path}}"></td>
            @else
                <td>no image</td>
            @endif
            <td><a href="{{route('posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
            <td>{{$post->category->name}}</td>
            <td>{{$post->title}}</td>
            <td>{{str_limit($post->body, 40)}}</td>
            <td><a href="{{route('home.post', $post->slug)}}">View Post</a> </td>
            <td><a href="{{route('comments.show', $post->id)}}">View Comments</a> </td>
            <td>{{$post->created_at->toFormattedDateString()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
       @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->render() }}

        </div>
    </div>

@endsection