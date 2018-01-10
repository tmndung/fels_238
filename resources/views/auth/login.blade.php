@extends('auth.layouts.master')

@section('title', trans('lang.login'))

@section('content')
    <div class="login-content">
        <div class="login-top">
            <h2 class="inner-tittle page">@lang('lang.websiteName')</h2>
        
            <div class="login">
                <h3 class="inner-tittle t-inner">@lang('lang.login')</h3>
                <div class="buttons login">
                    <ul>
                        <li><a href="#" class="hvr-sweep-to-right">@lang('lang.facebook')</a></li>
                        <li class="lost"><a href="#" class="hvr-sweep-to-left">@lang('lang.twitter')</a> </li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                {{ Form::open(['route' => 'login', 'class' => 'form-horizontal']) }}
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::email('email', old('email'), ['id' => 'email', 'class' => 'text', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('lang.emailAddress')]) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::password('password', ['id' => 'password', 'required' => 'required', 'placeholder' => '********']) }}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="new">
                        <p>
                            <label class="checkbox11">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <i></i>@lang('lang.rememberMe')
                            </label>
                        </p>
                    </div>
                    <div class="submit">
                        {{ Form::submit(trans('lang.login')) }}
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="new">
                        <a href="{{ route('password.request') }}">
                            @lang('lang.forgotPass')
                        </a>
                        <p class="sign">
                            @lang('lang.notHaveAccount')
                            <a href="{{ route('register') }}">@lang('lang.register')</a>
                        </p>
                        <br/>
                        <a class="return-home" href="{{ route('home') }}">@lang('lang.backHome')</a>
                        <div class="clearfix"></div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
