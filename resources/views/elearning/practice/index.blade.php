@extends ('templates.elearning.test')

@section ('title', trans('lang.test'))

@section ('init')
    {{ Html::script('templates/elearning/js/time.js') }}
@endsection

@section ('content')
    <div class="progress-bar-test row">
        <div class="progress-test custom-time display-time-test col-sm-1 col-xs-12">
        </div>
        <div class="col-sm-9 col-xs-12">
            
        </div>
        <div class="btn-exit-test col-sm-2 col-xs-12">
            <a class="btn-learn exit-learning" href="{{ $routeRedirect }}" onclick="return confirm('Are you sure ? ')">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="wrapper-all">
        <div class="wrapper-test">
            <div class="include-test" id="include-test">
                <div class="content-test animated fadeInRight" tid='{{ $question->test_id }}'>
                    <h2 class="content-question" qid={{ $question->id }}>{{ $question->content }}</h2>

                    <div class="answer-test" id="{{ $question->id }}">
                        <ul>
                            @foreach ($answers as $answer)
                                <li class="choose-answer-practice" id={{ $answer->id }}><span>{{ $answer->content }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-action-test row">
            <div class="col-sm-6 action-img">
                <div class="action-show" id="right-answer">
                    <img class="right-wrong-img" src="{{ config('setting.url_image_right') }}">
                    <span>@lang('lang.right')</span>
                </div>
                <div class="action-show" id="wrong-answer">
                    <img class="right-wrong-img" src="{{ config('setting.url_image_wrong') }}">
                    <span>@lang('lang.wrong')</span>
                </div>
            </div>
            <div class="col-sm-6 action-test btn-next-practice">
                <a href="">@lang('lang.skip')</a>
            </div>
        </div>
    </div>
@endsection
