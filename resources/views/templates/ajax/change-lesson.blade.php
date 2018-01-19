{{ Html::script('templates/elearning/js/script.js') }}
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
    <div class="lesson-center-content full-width clearfix animated {{ $data['animate'] }}">
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
            <a class="btn btn-learn btn-wordlist" href="{{ route('elearning.courses.wordlist.show', [$data['course']->id, $data['lesson']->id]) }}">
                @lang('lang.wordList')
            </a>
            @if ($data['roleShowBtn'] == config('setting.notFinished'))
                <a class="btn btn-learn" href="{{ route('elearning.courses.lesson.learn.index', [$data['course']->id, $data['lesson']->id]) }}">
                    @lang('lang.learn')
                </a>
                <a class="btn btn-learn bg-color-3" href="">
                    @lang('lang.test')
                </a>
            @elseif ($data['roleShowBtn'] == config('setting.learnedButNotFinished'))
                <a class="btn btn-learn bg-color-1" href="" data-toggle="dropdown">
                    @lang('lang.review') ({{ count($data['lesson']->wordLists) }})
                </a>
                <ul class="dropdown-menu review-menu">
                    <li>
                        <a href="">{{ trans('lang.easy') . config('setting.easyMode') . trans('lang.minute') }}</a>
                    </li>
                    <li>
                        <a href="">{{ trans('lang.medium') . config('setting.mediumMode') . trans('lang.minute') }}</a>
                    </li>
                    <li>
                        <a href="">{{ trans('lang.hard') . config('setting.hardMode') . trans('lang.minute') }}</a>
                    </li>
                </ul>
                <a class="btn btn-learn bg-color-3" href="">
                    @lang('lang.test')
                </a>
            @elseif ($data['roleShowBtn'] == config('setting.finishedLesson'))
                <a class="btn btn-learn bg-color-1" href="" data-toggle="dropdown">
                    @lang('lang.review') ({{ count($data['lesson']->wordLists) }})
                </a>
                <ul class="dropdown-menu review-menu">
                    <li>
                        <a href="">{{ trans('lang.easy') . config('setting.easyMode') . trans('lang.minute') }}</a>
                    </li>
                    <li>
                        <a href="">{{ trans('lang.medium') . config('setting.mediumMode') . trans('lang.minute') }}</a>
                    </li>
                    <li>
                        <a href="">{{ trans('lang.hard') . config('setting.hardMode') . trans('lang.minute') }}</a>
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
