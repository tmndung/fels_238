@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-address-book"></i>  @lang('lang.addCourse')</h2>

    @include('common.errors')

    {{ Form::open(['route' => ['admin.courses.store'], 'files' => 'true']) }}
        {{ Form::label('left', trans('lang.courseName') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('name', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>

        {{ Form::label('left', trans('lang.category') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::select('category_id', $categories, '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>

        {{ Form::label('left', trans('lang.information') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::textarea('information', '', ['class' => 'input-right text-area']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>

        {{ Form::label('left', trans('lang.totalLesson') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('number_of_lesson', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>

        {{ Form::label('left', trans('lang.picture') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::file('picture', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>

        {{ Form::submit(trans('lang.addBtn'), ['class' => 'button']) }}
    {{ Form::close() }}
@endsection
