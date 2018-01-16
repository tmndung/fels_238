@extends ('templates.elearning.test')

@section ('content')
    <div class="wrapper-all">
        <div class="wrapper-test">
            <h2 class="title-end-test">@lang('lang.bai_lam_ket_thuc')</h2>
            @if (count($score))
                <h4 class="score-end-test">@lang('lang.score_end'){{ $score }}</h4>
            @endif
            <p class="{{ ($score >= $scorePass) ? 'pass-test' : 'not-pass-test' }}">
                {{ ($score >= $scorePass) ? trans('lang.past_test') : trans('lang.not_past_test') }}
            </p>
        </div>
        <div class="wrapper-action-test row">
            @if ($score < $scorePass)
                <div class="col-sm-6 action-test">
                    <a href="{{ route('elearning.test.index', $id) }}">@lang('lang.reword')</a>
                </div>
            @else
                <div class="col-sm-6 col-sm-offset-6 action-test btn-continue">
                    <a href="">@lang('lang.continue')</a>
                </div>
            @endif
        </div>
    </div>
@endsection
