<div class="progress-content learning-header endlearning-header"></div>
<div class="learning-content animated fadeInRight">
    <div class="endlearning-title">
        <img src="{{ config('setting.congratIcon') }}">
    </div>
    <div class="endlearning-message">
        @lang('lang.messageLearned')
    </div>
    <div class="endlearning-totalword">
        @lang('lang.totalWord') {{ count($lesson->wordLists) }}
    </div>
</div>
<div class="progress-content learning-footer endlearning-footers">
    <div class="action-test btn-text btn-learning-next">
        <a href="{{ route('elearning.courses.lesson.show', [$course->id, $lesson->id]) }}">@lang('lang.ok')</a>
    </div>
</div>
