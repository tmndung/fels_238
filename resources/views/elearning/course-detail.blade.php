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
                </ol>
            </div>
        </div>
    </section>

    <section class="mainContent full-width clearfix course-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <div class="teachersPhoto">
                        <img src="{{ $data['course']->picture_path }}" alt="image" class="img-rounded img-responsive">
                        @if (!$data['isActiveCourse'])
                            <a class="btn-learn" href="{{ route('elearning.courses.lesson.show', [$data['course']->id, config('setting.lessonStart')]) }}">
                                @lang('lang.btnLearn')
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8 col-xs-12">
                    <div class="teachersInfo">
                        <h3>{{ $data['course']->name }}</h3>
                        <p>{{ $data['course']->information }}</p>
                    </div>
                    <a class="btn-learn btn-wordlist" href="{{ route('elearning.courses.wordlist.show', [$data['course']->id, 0]) }}">
                        @lang('lang.wordList')
                    </a>
                </div>
            </div>
        </div>

        <div class="full-width clearfix course-detail-content" id="x">
            <div class="course-detail-left col-sm-9 col-xs-12">
                @if ($data['isActiveCourse'])   
                    <div class="progress-content progress-course-content">
                        @include('templates.elearning.progress')
                    </div>
                @endif
                <div class="course-main-content">
                    <ul class="full-width clearfix">
                        @foreach ($data['course']->lessons as $lesson)
                            <li class="col-sm-3 col-xs-12 block">
                                <a href="{{ route('elearning.courses.lesson.show', [$data['course']->id, $lesson->id]) }}">
                                    <div class="lesson-title">{{ trans('lang.lesson') . ' ' . $loop->iteration }}</div>
                                    <div class="lesson-content">
                                        @if ($data['isActiveCourse'] && in_array($lesson->id, $data['idLessonsFinished']))
                                            <img src="{{ config('setting.learnIcon') }}" class="learn-icon">
                                            <img src="{{ config('setting.checkIcon') }}" class="check-icon">
                                        @else
                                            <img src="{{ config('setting.unlearnIcon') }}" class="unlearn-icon">
                                            <div class="lock"><i class="fa fa-lock"></i></div>
                                        @endif
                                    </div>
                                    <div class="lesson-name">{{ ucfirst(str_limit($lesson->name, 15)) }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12 course-detail-right">
                <div class="leaderboard">
                    <div class="leaderboard-header">
                        <img src="/templates/elearning/images/Leaderboard_Icon.png" class="leaderboard-icon">
                        <div class="leaderboard-text">@lang('lang.leaderboard')</div>
                    </div>
                    <div class="leaderboard-content">
                        <ul>
                            @foreach ($data['studies'] as $study)
                                @Auth
                                    <li class="{{ ($study->user->id == Auth::user()->id) ? 'my-leader' : '' }}">
                                @else
                                    <li>
                                @endauth
                                    <a href="{{ route('elearning.profile.show', $study->user->id) }}">
                                        <img src="{{ config('setting.rank' . $loop->iteration) }}" class="rank-icon">
                                        <span class="rank-position">{{ $loop->iteration . '. ' }}</span>
                                        <img src="{{ $study->user->avatar_path }}" class="avatar-leader">
                                        <span class="user-leader">{{ str_limit($study->user->name, 7) }}</span>
                                        <span class="score-leader">{{ $study->score }}</span>
                                    </a>
                                </li>
                            @endforeach
                            @if ($data['isActiveCourse'] && ($data['myRank'] > config('setting.topUser')))
                                <li class="my-leader">
                                    <a href="{{ route('elearning.profile.show', Auth::user()->id) }}">
                                        <img src="{{ config('setting.rank0') }}" class="rank-icon">
                                        <span class="rank-position">{{ $data['myRank'] . '. ' }}</span>
                                        <img src="{{ Auth::user()->avatar_path }}" class="avatar-leader">
                                        <span class="user-leader">{{ str_limit(Auth::user()->name, 7) }}</span>
                                        <span class="score-leader">{{ $data['myScore'] }}</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="">@lang('lang.more')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
