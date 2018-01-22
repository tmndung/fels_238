@extends('templates.elearning.master')

@section('content')
    <!-- PAGE TITLE SECTION-->
    <section class="pageTitleSection">
        <div class="container">
            <div class="pageTitleInfo">
                <h2>{{ $data['course']->name }}</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">@lang('lang.homeLow')</a></li>
                    @foreach ($data['categoriesParent'] as $category)
                        <li>
                            <a href="{{ route('elearning.category.show', $category->id) }}">{{ ucfirst($category->name) }}</a>
                        </li>
                    @endforeach
                    <li><a href="{{ route('elearning.courses.show', $data['course']->id) }}">
                        {{ ucfirst($data['course']->name) }}
                    </a>
                    <li>@lang('lang.lesson')</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- MAIN SECTION -->
    <section class="mainContent lesson-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <div class="teachersPhoto">
                        <img src="{{ $data['course']->picture_path }}" alt="image" class="img-rounded img-responsive">
                    </div>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <div class="teachersInfo">
                        <h3>{{ $data['course']->name }}</h3>
                        <p>{{ $data['course']->information }}</p>
                    </div>
                    <a class="btn-learn btn-wordlist" href="{{ route('elearning.courses.show', $data['course']->id) }}">@lang('lang.course')</a>
                </div>
            </div>
        </div>
            
        <div class="lesson-content full-width clearfix">
            <div class="col-sm-2 col-xs-12" >
                @if ($data['preLesson'])
                    <a href="" class="btn-lesson" lesson="{{ $data['preLesson']->id }}" course="{{ $data['course']->id }}" animate="fadeInLeft">
                @else
                    <a href="" class="btn-lesson activeLessonBtn">
                @endif
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>@lang('lang.preLesson') 
                </a>
            </div>
            <div class="col-sm-8 col-xs-12">
                <div class="lesson-center-content full-width clearfix">
                    <div class="col-sm-3 col-xs-12 lesson-img">
                        <div>@lang('lang.status')</div>
                        @if ($data['roleShowBtn'] == config('setting.notFinished') || $data['roleShowBtn'] == config('setting.learnedButNotFinished'))
                            <img src="{{ config('setting.unlearnIcon') }}" class="unlearn-icon-lesson">
                            <div class="lock-icon-lesson"><i class="fa fa-lock"></i></div>
                        @else
                            <img src="{{ config('setting.learnIcon') }}" class="learn-icon-lesson">
                            <img src="{{ config('setting.checkIcon') }}" class="check-icon-lesson">
                        @endif
                    </div>
                    <div class="col-sm-9 col-xs-12 lesson-center-main teachersInfo progress-wordlist-content">
                        <h3>{{ trans('lang.lesson') . ' ' . $data['numOfLesson'] . ' - ' .  $data['lesson']->name }}</h3>
                        <p>{{ $data['lesson']->content }}</p>
                        <p class="info-word-point">
                            @lang('lang.word'): 
                            <span class="color-4-bold">{{ count($data['lesson']->wordLists) }}</span>
                            <br/>
                            @lang('lang.point'): 
                            <span class="color-1-bold">{{ $data['lesson']->point }}</span>
                        </p>
                        <a class="btn btn-learn btn-wordlist" href="{{ route('elearning.courses.wordlist.show', [$data['course']->id, $data['lesson']->id]) }}">
                            @lang('lang.wordList')
                        </a>
                        @if ($data['roleShowBtn'] == config('setting.notFinished'))
                            <a class="btn btn-learn" href="{{ route('elearning.courses.lesson.learn.index', [$data['course']->id, $data['lesson']->id]) }}" onclick="return confirm('{{ trans('lang.msgReady') }}')">
                                @lang('lang.learn')
                            </a>
                            <a class="btn btn-learn bg-color-3" href="{{ route('elearning.test.index', $data['lesson']->id) }}" onclick="return confirm('{{ trans('lang.msgReady') }}')">
                                @lang('lang.test')
                            </a>
                        @elseif ($data['roleShowBtn'] == config('setting.learnedButNotFinished'))
                            <a class="btn btn-learn bg-color-1" href="" data-toggle="dropdown">
                                @lang('lang.review') ({{ count($data['lesson']->wordLists) }})
                            </a>
                            <ul class="dropdown-menu review-menu">
                                <li>
                                    <a href="" id="review-word" message="{{ trans('lang.msgReady') }}">{{ trans('lang.reviewWord') }}</a>
                                    {{ Form::open(['route' => ['elearning.review.word.lesson', $data['course'], $data['lesson']->id], 'method' => 'GET', 'id' => 'form-review-word']) }}
                                    {{ Form::close() }}
                                </li>
                                <li>
                                    <a href="">{{ trans('lang.practice') }}</a>
                                </li>
                            </ul>
                            <a class="btn btn-learn bg-color-3" href="{{ route('elearning.test.index', $data['lesson']->id) }}" onclick="return confirm('{{ trans('lang.msgReady') }}')">
                                @lang('lang.test')
                            </a>
                        @elseif ($data['roleShowBtn'] == config('setting.finishedLesson'))
                            <a class="btn btn-learn bg-color-1" href="" data-toggle="dropdown">
                                @lang('lang.review') ({{ count($data['lesson']->wordLists) }})
                            </a>
                            <ul class="dropdown-menu review-menu">
                                <li>
                                    <a href="" id="review-word" message="{{ trans('lang.msgReady') }}">{{ trans('lang.reviewWord') }}</a>
                                    {{ Form::open(['route' => ['elearning.review.word.lesson', $data['course'], $data['lesson']->id], 'method' => 'GET', 'id' => 'form-review-word']) }}
                                    {{ Form::close() }}
                                </li>
                                <li>
                                    <a href="">{{ trans('lang.practice') }}</a>
                                </li>
                            </ul>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-sm-2 col-xs-12">
                @if ($data['nextLesson'])
                    <a href="" class="btn-lesson" lesson="{{ $data['nextLesson']->id }}" course="{{ $data['course']->id }}" animate="fadeInRight">
                @else
                    <a href="" class="btn-lesson activeLessonBtn">
                @endif
                    @lang('lang.nextLesson')<i class="fa fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
