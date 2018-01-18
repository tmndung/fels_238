@extends ('templates.elearning.test')

@section ('title', trans('lang.learning'))

@section ('content')
    <div class="learning-container">
        <div class="progress-content learning-header full-width clearfix">
            <div class="progress progress-learning col-sm-10 col-xs-12">
                <div class="progress-bar progress-bar-success animated fadeInLeft progress-bar-course" role="progressbar" id="progress-learning" progress="{{ $progressVal }}" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progressVal }}%">
                </div>
            </div>
            <div class="col-sm-2 col-xs-12">
                <a href="{{ route('elearning.courses.lesson.show', [$course->id, $lesson->id]) }}" class="btn-learn exit-learning" onclick="return confirm('{{ trans('lang.msgDel') }}')">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div class="learning-content">
            <div class="learning-word full-width clearfix">
                <div class="learning-title col-sm-2 col-xs-12">
                    @lang('lang.newWord')
                </div>
                <div class="learning-word-content col-sm-10 col-xs-12">
                    {{ ucfirst($word->name) }}
                    <div class="listen-word">
                        <i class="fa fa-volume-up" aria-hidden="true" id="play-word-audio"></i>
                    </div>
                    <audio id="listent-audio" controls">
                        <source src="{{ $word->file_listen_path }}" type="audio/mpeg">
                    </audio>
                </div>
            </div>
            <div class="learning-word full-width clearfix">
                <div class="learning-title col-sm-2 col-xs-12">
                    @lang('lang.pronunciation')
                </div>
                <div class="learning-pronunciation-content col-sm-10 col-xs-12">
                    {{ $word->pronunciation }}
                </div>
            </div>
            <div class="learning-word full-width clearfix">
                <div class="learning-title col-sm-2 col-xs-12">
                    @lang('lang.explain')
                </div>
                <div class="learning-explain-content col-sm-10 col-xs-12">
                    {{ ucfirst($word->explain) }}
                </div>
            </div>
        </div>
        
        <div class="progress-content learning-footer full-width clearfix">
            <div class="action-test btn-text btn-learning-next">
                <a href="" id="next-lesson" lesson="{{ $lesson->id }}" offsetProgress="{{ $offsetProgress }}" course="{{ $course->id }}">   @lang('lang.next')
                </a>
            </div>
        </div>
    </div>
@endsection
