@extends('auth.layouts.master')

@section('title', trans('lang.resetPass'))

@section('content')
    <div class="login-content new-pass-content">
        <div class="login-top reset-top">
            <h2 class="inner-tittle page new-pass-title">@lang('lang.websiteName')</h2>
            <div class="login">
                <h3 class="inner-tittle t-inner">@lang('lang.resetPass')</h3>
                {{ Form::open(['route' => 'password.request', 'class' => 'form-horizontal']) }}
                    {{ Form::hidden('token', $token) }}
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::email('email', ($email or old('email')), ['id' => 'email', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('lang.emailAddress')]) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::password('password', ['id' => 'password', 'required' => 'required', 'placeholder' => 'New Password']) }}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'required' => 'required', 'placeholder' => trans('lang.passConfirm')]) }}
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong class="vali-msg">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="submit">
                        {{ Form::submit(trans('lang.resetPass')) }}
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
                </form>
            </div>
        </div>
    </div>
@endsection
