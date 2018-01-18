<div>
    <strong>{{ $data['learnedWord'] . '/' . $data['totalWord'] . ' ' . trans('lang.word') }}</strong>
</div>
<div>
    <strong>{{ count($data['idLessonsFinished']) . '/' . count($data['course']->lessons) . ' ' . trans('lang.lesson') }}</strong>
</div>
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
    <a class="btn-learn " href="{{ route('elearning.courses.lesson.show', [$data['course']->id, $data['lesson']->id]) }}">
        @lang('lang.learn')
    </a>
</div>
