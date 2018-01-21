<div class="progress-content learning-header endlearning-header"></div>
<div class="learning-content animated fadeInRight">
    <div class="endlearning-title">
        <img src="{{ config('setting.congratIcon') }}">
    </div>
    <div class="endlearning-message">
        {{ $msg or trans('lang.messageLearned') }}
    </div>
    <div class="endlearning-totalword">
        @lang('lang.totalWord') {{ $totalWord }}
    </div>
    <div class="bonus-point">
        {{ $msgPointBonus or '' }}
    </div>
</div>
<div class="progress-content learning-footer endlearning-footers">
    <div class="action-test btn-text btn-learning-next">
        <a href="{{ $routeRedirect }}">@lang('lang.ok')</a>
    </div>
</div>
