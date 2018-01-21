{{ Html::script('templates/elearning/js/script.js') }}
{{ Html::script('templates/elearning/js/result.js') }}
<div class="wrapper-all">
    <div class="wrapper-test">
        @if ($score < $scorePass)
            <h2 class="title-end-test">@lang('lang.end_test')</h2>
        @else
            <div class="endlearning-title">
                <img src="/templates/elearning/images/congrat.png">
            </div>
        @endif
        @if (count($score))
            <h4 class="score-end-test">@lang('lang.score_end'){{ $score }}</h4>
        @endif
        <p class="{{ ($score >= $scorePass) ? 'pass-test' : 'not-pass-test' }}">
            {{ ($score >= $scorePass) ? trans('lang.past_test') : trans('lang.not_past_test') }}
        </p>
        <div class="bonus-point">
            {{ $msgPointBonus or '' }}
        </div>
    </div>
    <div class="wrapper-action-test row">
        @if ($score < $scorePass)
            <div class="col-sm-6 action-test">
                <a href="{{ route('elearning.test.index', $idLesson) }}">@lang('lang.reword')</a>
            </div>
        @else
            <div class="col-sm-6 col-sm-offset-6 action-test btn-continue">
                <a href="">@lang('lang.continue')</a>
            </div>
        @endif
    </div>
</div>
