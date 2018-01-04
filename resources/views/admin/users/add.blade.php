@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-user-plus"></i>  @lang('lang.addUser')</h2>

    @include('common.errors')

    {{ Form::open(['route' => 'admin.users.store']) }}
        {{ Form::label('left', trans('lang.username') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('name', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::label('left', trans('lang.password') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::password('password', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::label('left', trans('lang.passConfirm') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::password('password-confirmation', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div> 
        {{ Form::label('left', trans('lang.email') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('email', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::submit(trans('lang.addBtn'), ['class' => 'button']) }}
    {{ Form::close() }}
@endsection
