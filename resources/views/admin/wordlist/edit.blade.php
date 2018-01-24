@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-list-alt"></i>  @lang('lang.edit_wordlist')</h2>
    
    @include ('common.errors')

    @if (count($wordlist))
        {{ Form::open(['route' => ['admin.wordlist.update', $wordlist->id]]) }}
            {{ method_field('PUT') }}
            {{ Form::label('left', trans('lang.word') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('name', $wordlist->name, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.pronunciation') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('pronunciation', $wordlist->pronunciation, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.explain') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::textarea('explain', $wordlist->explain, ['class' => 'input-right text-area']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.lesson'), ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::select('lesson_id', $lessons, $wordlist->lesson_id, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.audio'), ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::file('file_listen', ['class' => 'input-right']) }}
            </div>
            <div class="clr"></div> 
            {{ Form::submit(trans('lang.editBtn'), ['class' => 'button']) }}
        {{ Form::close() }}
    @endif
@endsection
