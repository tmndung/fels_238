<!-- validation error -->
@if (count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- database error -->
@if (Session::has('messages'))
    <div class="alert alert-danger">      
        <h5>{{ Session::get('messages') }}</h5>
    </div>
@endif
