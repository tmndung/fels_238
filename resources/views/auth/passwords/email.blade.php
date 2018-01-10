@extends('auth.layouts.master')

@section('title', trans('lang.mailReset'))

@section('content')
    <div class="login-content reset-content">
        <div class="login-top reset-top">
            <h2 class="inner-tittle page reset-title">@lang('lang.websiteName')</h2>
        
            <div class="login">
                <h3 class="inner-tittle t-inner">@lang('lang.mailReset')</h3>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                {{ Form::open(['route' => 'password.email', 'class' => 'form-horizontal']) }}
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::email('email', old('email'), ['id' => 'email', 'required' => 'required', 'placeholder' => trans('lang.emailAddress')]) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="submit">
                        {{ Form::submit(trans('lang.sendLinkReset')) }}
                    </div>
                    <div class="new">
                        <p class="sign">
                            <a href="{{ route('login') }}">@lang('lang.login')</a>
                            |
                            <a href="{{ route('register') }}">@lang('lang.register')</a>
                        </p>
                        <br/>
                        <a class="return-home" href="{{ route('home') }}">@lang('lang.backHome')</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
