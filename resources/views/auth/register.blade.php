@extends('auth.layouts.master')

@section('title', trans('lang.register'))

@section('content')
    <div class="login-content">
        <div class="login-top up">
            <h2 class="inner-tittle page">@lang('lang.websiteName')</h2>
            <div class="login">
                <h3 class="inner-tittle t-inner">@lang('lang.register')</h3>
                {{ Form::open(['route' => 'register', 'class' => 'form-horizontal']) }}
                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::text('name', old('name'), ['id' => 'name', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('lang.username')]) }}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::email('email', old('email'), ['id' => 'email', 'class' => 'text', 'required' => 'required', 'placeholder' => trans('lang.emailAddress')]) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::password('password', ['id' => 'password', 'required' => 'required', 'placeholder' => trans('lang.password')]) }}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'required' => 'required', 'placeholder' => trans('lang.passConfirm')]) }}
                    </div>
                    <div class="submit">
                        {{ Form::submit(trans('lang.register')) }}
                    </div>
                    <div class="clearfix"></div>
                    <div class="buttons">
                        <ul>
                            <li>
                                <a href="{{ route('authenticate', 'facebook') }}" class="facebook-login">
                                    <i class="fa fa-facebook fb-tw-gg-icon" aria-hidden="true"></i>
                                    @lang('lang.signUp')
                                </a>
                            </li>
                            <li class="or"><h6>@lang('lang.or')</h6></li>
                            <li >
                                <a href="{{ route('authenticate', 'google') }}" class="google-login">
                                    <i class="fa fa-google-plus fb-tw-gg-icon" aria-hidden="true"></i>
                                    @lang('lang.signUp')
                                </a>
                            </li>
                            <li class="or"><h6>@lang('lang.or')</h6></li>
                            <li class="lost">
                                <a href="{{ route('authenticate', 'twitter') }}" class="twitter-login">
                                    <i class="fa fa-twitter fb-tw-gg-icon" aria-hidden="true"></i>
                                    @lang('lang.signUp')
                                </a>
                            </li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                    <div class="new">
                        <p class="sign up">@lang('lang.haveAccount')<a href="{{ route('login') }}"> @lang('lang.loginHere')</a></p>
                        <br/>
                        <a class="return-home" href="{{ route('home') }}">@lang('lang.backHome')</a>
                        <div class="clearfix"></div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
