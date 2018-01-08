@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-list-alt "></i>  @lang('lang.add_wordlist')</h2>
    
    @include ('common.errors')

    {{ Form::open(['route' => 'admin.wordlist.store']) }}
        {{ Form::label('left', trans('lang.word') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('name', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::label('left', trans('lang.pronunciation') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('pronunciation', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::label('left', trans('lang.explain') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::textarea('explain', '', ['class' => 'input-right text-area']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::label('left', trans('lang.lesson'), ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::select('lesson_id', $lessons, '0', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div> 
        {{ Form::submit(trans('lang.addBtn'), ['class' => 'button']) }}
    {{ Form::close() }}
@endsection
