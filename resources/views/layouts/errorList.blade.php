@if(count($errors))
    <div class="form-group">
        <div class="alert alert-danger alert-important">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif