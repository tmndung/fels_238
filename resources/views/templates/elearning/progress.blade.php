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
<div class="progress-footer full-width clearfix">
    <div class="col-sm-6 col-xs-12">
        <a href="" class="btn btn-option dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cog option-icon" aria-hidden="true"></i>
            @lang('lang.option')
        </a>
        <ul class="dropdown-menu option-menu">
            <li>
                <a href="#" data-role="course-restart" id="option-restart" message="{{ trans('lang.msgDel') }}">
                    <i class="fa fa-refresh option-icon" aria-hidden="true"></i>
                    @lang('lang.restart')
                    {{ Form::open(['route' => ['elearning.courses.update', $data['course']->id], 'id' => 'restart-course-form']) }}
                        {{ method_field('PUT') }}
                    {{ Form::close() }}
                </a>
            </li>
            <li>
                <a href="" data-role="course-unenroll" id="option-quit" message="{{ trans('lang.msgDel') }}">
                    <i class="fa fa-stop option-icon" aria-hidden="true"></i>
                    @lang('lang.quit')
                    {{ Form::open(['route' => ['elearning.courses.destroy', $data['course']->id], 'id' => 'quit-course-form']) }}
                        {{ method_field('DELETE') }}
                    {{ Form::close() }}
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-progress col-sm-6 col-xs-12">
        @if ($data['learnedWord'])
            <a class="btn-learn bg-color-1 dropdown-toggle" href="" data-toggle="dropdown">
                @lang('lang.review') ({{ $data['learnedWord'] }})
            </a>
            <ul class="dropdown-menu review-menu">
                <li>
                    <a href="" id="review-word" message="{{ trans('lang.msgReady') }}">{{ trans('lang.reviewWord') }}</a>
                    {{ Form::open(['route' => ['elearning.review.word.course', $data['course']], 'method' => 'GET', 'id' => 'form-review-word']) }}
                    {{ Form::close() }}
                </li>
                <li>
                    <a href="{{ route('elearning.practicecourse.index', $data['course']->id) }}">{{ trans('lang.practice') }}</a>
                </li>
            </ul>
        @endif
        @if (count($data['idLessonsFinished']) < count($data['course']->lessons))
            <a class="btn-learn " href="{{ route('elearning.courses.lesson.show', [$data['course']->id, $data['lesson']->id]) }}">
                @lang('lang.learn')
            </a>
        @endif
    </div>
</div>
