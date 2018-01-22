{{ Html::script('templates/elearning/js/script.js') }}
{{ Html::script('templates/elearning/js/result.js') }}
<div class="wrapper-all">
    <div class="wrapper-test">
        <h2 class="title-end-test color-green">@lang('lang.finish_practice')</h2>
        <div>
            <ul class="result-practice">
                <li><i class="fa fa-vimeo" aria-hidden="true"> </i>@lang('lang.number_of_correct') {{ $numberCorrect }}</li>
                <li><i class="fa fa-percent" aria-hidden="true"> </i>@lang('lang.accuracy') {{ round(($numberCorrect*100)/$numberQuestion) }} %</li>
                <li><i class="fa fa-clock-o" aria-hidden="true"> </i>@lang('lang.time') <span class="displate-time-practice"></span></li>
            </ul>
        </div>
    </div>
    <div class="wrapper-action-test row">
        <div class="col-sm-6 col-sm-offset-6 action-test btn-continue">
            <a href="{{ $routeRedirect }}">@lang('lang.continue')</a>
        </div>
    </div>
</div>
