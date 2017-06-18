@extends('layouts.admin')


@section('content')

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
                <td> <img height="100" src="{{$user->photo->path}}"></td>
            @else
                <td>no image</td>
            @endif
           {{-- <td><?php echo isset($user->photo) ? "<img src='$user->photo->path'>" : 'No User Photo' ?></td>--}}
            <td>{{$user->name}}</td>
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