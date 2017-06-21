@extends('layouts.admin')


@section('content')

    {{--@if(\Illuminate\Support\Facades\Session::has('deleted_user'))

        <h3 class="bg-primary center-block">{{session('deleted_user')}}</h3>

    @endif--}}
    <div class="alert">
       <h3> @include('flash::message')</h3>
    </div>

    <h1>Users</h1>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            @if($user->photo)
                <td> <img height="50" src="{{$user->photo->path}}"></td>
            @else
                <td>no image</td>
            @endif
            <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->status == 1 ? 'yes' : 'no'}}</td>
            <td>{{$user->created_at->toFormattedDateString()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach

        </tbody>
    </table>



@endsection