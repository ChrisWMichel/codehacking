@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0)
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
            <td><a href="{{route('replies.show', $comment->id)}}">View Replies</a> </td>
            <td>

                @if($comment->is_active == 1)
                    {!! Form::model($comment,['method'=>'patch', 'action'=>['PostCommentsController@update',  $comment->id]]) !!}
                    {{csrf_field()}}

                    <input type="hidden" name="is_active" value="0">

                    <div class="form-group">
                        {!! Form::submit('un-approve', null, ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}

                @else
                    {!! Form::model($comment, ['method'=>'patch', 'action'=> ['PostCommentsController@update',  $comment->id]]) !!}
                    {{csrf_field()}}

                    <input type="hidden" name="is_active" value="1">

                    <div class="form-group">
                        {!! Form::submit('approve', null, ['class' => 'btn btn-info']) !!}
                    </div>

                    {!! Form::close() !!}
                @endif
                </td>

                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <h1 class="text-center">No Comments</h1>
    @endif



@endsection