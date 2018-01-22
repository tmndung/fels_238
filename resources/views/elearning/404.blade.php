@extends('templates.elearning.master')

@section('content')
<section class="pageTitleSection">
    <div class="container">
        <div class="pageTitleInfo">
            <h2>@lang('lang.errorPage')</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">@lang('lang.homeLow')</a></li>
                <li class="active">@lang('lang.errorPage')</li>
            </ol>
        </div>
    </div>
</section>
<section class="mainContent full-width clearfix">
    <div class="container">
        <div class="row">
            <div class="errorMsg col-sm-4 col-sm-offset-1 col-xs-12">
              <img src="{{ config('setting.errorImg') }}" alt="error image" class="img-responsive">
            </div>
            <div class="errorInfo col-sm-6 col-xs-12">
                <h3>@lang('lang.oop')</h3>
                <p>@lang('lang.msgErrorPage')</p>
                <div class="formBtnArea pull-left">
                    <a href="{{ route('home') }}" class="btn btn-primary bg-color-3">@lang('lang.backHome')</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
