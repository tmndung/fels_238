@extends ('templates.admin.master')

@section ('content')
    <center>
         <div class="page-404 animated flipInX">
            <img src="{{ config('setting.admin_404') }}" class="img-responsive"/>
                </br>
                <span class="icons icon-arrow-down"></span>
            </a>
         </div>
    </center>
@endsection
