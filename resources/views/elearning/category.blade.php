@extends('templates.elearning.master')

@section('content')
    <section class="pageTitleSection">
        <div class="container">
            <div class="pageTitleInfo">
                <h2>@lang('lang.all_category')</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">@lang('lang.home')</a></li>
                    <li class="active">
                        {{ isset($categoryName) ? $categoryName : trans('lang.all_course') }}
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <section class="mainContent bg-color-gray full-width clearfix coursesSection">
        <div class="container">
            <div class="sectionTitle text-center">
                <h2>
                    <span class="shape shape-left bg-color-4"></span>
                    <span>{{ isset($categoryName) ? $categoryName : trans('lang.all_course') }}</span>
                    <span class="shape shape-right bg-color-4"></span>
                </h2>
            </div>
            <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-3 col-sm-6 col-xs-12 block">
                    <div class="thumbnail thumbnailContent">
                        <a href="{{ route('elearning.courses.show', ['id' => $course->id]) }}">
                            {{ Html::image($course->picture_path, 'image', ['class' => 'img-responsive']) }}
                        </a>
                        <div class="caption border-color-{{ $loop->iteration }}">
                            <h3><a href="{{ route('elearning.courses.show', ['id' => $course->id]) }}" class="color-{{ $loop->iteration }}">{{ $course->name }}</a></h3>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{ route('elearning.category.show', ['id' => $course->category->id]) }}"><i class="fa fa-list" aria-hidden="true"></i>{{ $course->category->name }}</a>
                                </li>
                            </ul>
                            <p>{{ str_limit($course->information, 45) }}</p>
                            <ul class="list-inline btn-green">
                                <li><a href="{{ route('elearning.courses.show', ['id' => $course->id]) }}" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>@lang('lang.more')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        <div class="pagerArea text-center">
            {{ $courses->links() }}
        </div>
    </section>
@endsection
