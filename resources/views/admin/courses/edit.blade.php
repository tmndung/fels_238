@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-pencil"></i> @lang('lang.editCourse')</h2>

    @include('common.errors')

    @if (count($course))
        {{ Form::open(['route' => ['admin.courses.update', $course->id], 'files' => 'true']) }}
            {{ method_field('PUT') }}
            {{ Form::label('left', trans('lang.courseName') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('name', $course->name, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.category') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::select('category_id', $categories, $course->category_id, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.information') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::textarea('information', $course->information, ['class' => 'input-right text-area']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            
            {{ Form::label('left', trans('lang.totalLesson') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('number_of_lesson', $course->number_of_lesson, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.oldPicture'), ['class' => 'left-login']) }}
            <div class="right-login">
                <img src="{{ $course->picture_path }}" class="picture">
            </div>
            <div class="clr"></div>

            {{ Form::label('left', trans('lang.newPicture') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::file('picture', ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>

            {{ Form::submit(trans('lang.editBtn'), ['class' => 'button']) }}
        {{ Form::close() }}
    @endif
@endsection
