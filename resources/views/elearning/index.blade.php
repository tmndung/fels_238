@extends('templates.elearning.master')

@section('content')
<div>
    <img class="bg-index-fixed" src="/templates/elearning/images/bg-index-fixed.jpg">
</div>

@include ('elearning.index.slider')

@include ('elearning.index.courses')

@include ('elearning.index.randomCourses')

<section class="countUpSection" id="informationCourses">
    <div class="container">
        <div class="sectionTitleSmall">
            <h2>@lang('lang.information')</h2>
        </div>

        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <div class="text-center">
                    <div class="counter">{{ $count['category'] }}</div>
                    <div class="counterInfo bg-color-1">@lang('lang.categories')</div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="text-center">
                    <div class="counter">{{ $count['course'] }}</div>
                    <div class="counterInfo bg-color-2">@lang('lang.courses')</div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="text-center">
                    <div class="counter">{{ $count['lesson'] }}</div>
                    <div class="counterInfo bg-color-3">@lang('lang.lessons')</div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="text-center">
                    <div class="counter">{{ $count['student'] }}</div>
                    <div class="counterInfo bg-color-4">@lang('lang.students')</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
