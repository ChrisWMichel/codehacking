@extends('layouts.admin')

@section('content')

    @if(count($replies) > 0)
        <h1>Replies</h1>

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
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    {{-- <td>{{$comment->created_at->toDayDateTimeString()}}</td>--}}
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a> </td>
                    <td>

                        @if($reply->is_active == 1)
                            {!! Form::model($reply, ['method'=>'patch', 'action'=>['CommentRepliesController@update',  $reply->id]]) !!}
                            {{csrf_field()}}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('un-approve', null, ['class' => 'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}

                        @else
                            {!! Form::model($reply,['method'=>'patch', 'action'=> ['CommentRepliesController@update',  $reply->id]]) !!}
                            {{csrf_field()}}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('approve', null, ['class' => 'btn btn-info']) !!}
                            </div>

                            {!! Form::close() !!}
                        @endif
                    </td>

                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}

                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Replies</h1>
    @endif



@endsection