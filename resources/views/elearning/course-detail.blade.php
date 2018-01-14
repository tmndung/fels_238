@extends('templates.elearning.master')

@section('content')
        <!-- PAGE TITLE SECTION-->
        <section class="pageTitleSection">
            <div class="container">
                <div class="pageTitleInfo">
                    <h2>{{ $data['course']->name }}</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">@lang('lang.homeLow')</a></li>
                        @foreach ($data['categoriesParentName'] as $categoryName)
                            <li><a href="">{{ $categoryName }}</a></li>
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
                                <a class="btn-learn" href="">@lang('lang.btnLearn')</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="teachersInfo">
                            <h3>{{ $data['course']->name }}</h3>
                            <p>{{ $data['course']->information }}</p>
                        </div>
                        <a class="btn-learn btn-wordlist" href="{{ route('elearning.courses.wordlist.index', $data['course']->id) }}">@lang('lang.wordList')</a>
                    </div>
                </div>
            </div>

            <div class="full-width clearfix course-detail-content" id="x">
                <div class="course-detail-left col-sm-9 col-xs-12">
                    @if ($data['isActiveCourse'])   
                        <div class="progress-content">
                            <div><strong>{{ $data['learnedWord'] . '/' . $data['totalWord'] . ' ' . trans('lang.word') }}</strong></div>
                            <div><strong>{{ count($data['idLessonsLearned']) . '/' . count($data['course']->lessons) . ' ' . trans('lang.lesson') }}</strong></div>
                            <div class="progress progress-course">
                                <div class="progress-bar progress-bar-success animated fadeInLeft progress-bar-course" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $data['progressVal'] . '%' }}">
                                    {{ $data['progressVal'] . '%'}}
                                </div>
                            </div>
                            <div class="btn-progress">
                                @if ($data['learnedWord'])
                                    <a class="btn-learn bg-color-1" href="">
                                        @lang('lang.review') ({{ $data['learnedWord'] }})
                                    </a>
                                @endif
                                <a class="btn-learn " href="">@lang('lang.learn')</a>
                            </div>
                        </div>
                    @endif
                    <div>
                        <ul class="full-width clearfix">
                            @foreach ($data['course']->lessons as $lesson)
                                <li class="col-sm-3 col-xs-12 block">
                                    <a href="">
                                        <div class="lesson-title">{{ trans('lang.lesson') . ' ' . $loop->iteration }}</div>
                                        <div class="lesson-content">
                                            @if ($data['isActiveCourse'] && in_array($lesson->id, $data['idLessonsLearned']))
                                                <img src="{{ config('setting.learnIcon') }}" class="learn-icon">
                                                <img src="{{ config('setting.checkIcon') }}" class="check-icon">
                                            @else
                                                <img src="{{ config('setting.unlearnIcon') }}" class="unlearn-icon">
                                                <div class="lock"><i class="fa fa-lock"></i></div>
                                            @endif
                                        </div>
                                        <div class="lesson-name">{{ str_limit($lesson->name, 15) }}</div>
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
                                        <a href="">
                                            <img src="{{ config('setting.rank' . $loop->iteration) }}" class="rank-icon">
                                            <span class="rank-position">{{ $loop->iteration . '. '}}</span>
                                            <img src="{{ $study->user->avatar_path }}" class="avatar-leader">
                                            <span class="user-leader">{{ str_limit($study->user->name, 7) }}</span>
                                            <span class="score-leader">{{ $study->score }}</span>
                                        </a>
                                    </li>
                                @endforeach
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
