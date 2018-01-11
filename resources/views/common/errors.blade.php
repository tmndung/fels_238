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
        <ul>
            <li>{{ Session::get('messages') }}</li>
        </ul>
    </div>
@endif
@if (Session::has('confirmwrong'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ Session::get('confirmwrong') }}</li>
        </ul>
    </div>
@endif
<!-- database error -->
@if (Session::has('success'))
    <div class="alert alert-success fade in">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
