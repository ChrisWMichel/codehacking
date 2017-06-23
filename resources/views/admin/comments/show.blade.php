@extends('layouts.admin')

@section('content')

    @if($comments)
        <h1>Comments</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                {{-- <th>Created On</th>--}}
                <th>Post</th>

            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    {{-- <td>{{$comment->created_at->toDayDateTimeString()}}</td>--}}
                    <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a> </td>



                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Comments</h1>
    @endif



@endsection