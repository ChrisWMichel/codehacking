@extends('layouts.blog_post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->toDayDateTimeString()}}</p>

    <hr>
    <div class="alert">
        <h3> @include('flash::message')</h3>
    </div>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->path}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->body}}
    <hr>

    <!-- Blog Comments -->
@if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>


        {!! Form::open(['method' => 'Post', 'action'=>'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">
                {!! Form::label('body', 'Comment') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

    </div>
@endif
    <hr>

    <!-- Posted Comments -->
@if(count($comments) > 0)
    <!-- Comment -->
    @foreach($comments as $comment)
    <div class="media">

        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->toDayDateTimeString()}}</small>
            </h4>
                {{$comment->body}}
        </div>
        @if(count($comment->replies) == 0)
            <div class="comment-reply-container">

                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                <div class="comment-reply">

                    {!! Form::open(['method' => 'Post', 'action'=>'CommentRepliesController@createReply']) !!}

                    <input type="hidden" name="comment_id" value="{{$comment->id}}">

                    <div class="form-group">
                        {!! Form::label('body', 'Reply') !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows'=>1]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>{{--comment-reply--}}
            </div>
        @endif
    </div>

        @if(count($comment->replies) > 0)

            @foreach($comment->replies as $reply)

                    <div class="media nested-comment">

                    @if($reply->is_active == 1)
                    <!-- Nested Comment -->
                        <div class="media-body">
                            <h4 class="media-heading">{{$reply->author}}
                                <small>{{$reply->created_at->toDayDateTimeString()}}</small>
                            </h4>
                            {{$reply->body}}
                        </div>

                        <div class="comment-reply-container">

                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                        <div class="comment-reply">

                            {!! Form::open(['method' => 'Post', 'action'=>'CommentRepliesController@createReply']) !!}

                                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                <div class="form-group">
                                    {!! Form::label('body', 'Reply') !!}
                                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows'=>1]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                </div>

                            {!! Form::close() !!}
                        </div>{{--comment-reply--}}
                    </div>
                    <!-- End Nested Comment -->
                        @endif
                </div>
            @endforeach

        @endif

    @endforeach
@endif


@endsection

@section('scripts')
    <script>
        $('.comment-reply-container .toggle-reply').click(function () {
            $(this).next().slideToggle('slow');
        })
    </script>
@endsection