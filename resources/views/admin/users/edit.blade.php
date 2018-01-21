@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-pencil"></i> @lang('lang.editUser')</h2>

    @include('common.errors')

    @if (count($user))
        {{ Form::open(['route' => ['admin.users.update', $user->id], 'files' => 'true']) }}
            {{ method_field('PUT') }}
            {{ Form::label('left', trans('lang.username') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('name', $user->name, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.password'), ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::password('password', ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.description') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::textarea('description', $user->description, ['class' => 'input-right text-area']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.email') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('email', $user->email, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.oldAvatar'), ['class' => 'left-login']) }}
            <div class="right-login">
                <img src="{{ $user->avatar_path }}" class="old-avatar">
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.newAvatar') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::file('avatar', ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.oldBg'), ['class' => 'left-login']) }}
            <div class="right-login">
                <img src="{{ $user->background_path }}" class="old-bg">
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.newBg') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::file('background', ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::submit(trans('lang.editBtn'), ['class' => 'button']) }}
        {{ Form::close() }}
    @endif
@endsection
