@foreach ($randomCourses as $category => $randomCourse)
    <div class="border-images">
        @switch($loop->iteration)
            @case(config('setting.status1'))
                @lang('lang.status1')
                @break
            @case(config('setting.status2'))
                @lang('lang.status2')
                @break
            @case(config('setting.status3'))
                @lang('lang.status3')
                @break
        @endswitch
    </div>
    <section id='{{ $category }}' class="mainContent bg-index full-width clearfix featureSection pd-page-top-15">
        <div class="whiteSection bg-index pd-page-top-15">
            <div class="sectionTitle text-center">
                <h2>
                    <span class="shape shape-left bg-color-4"></span>
                    <span>{{ $category }}</span>
                    <span class="shape shape-right bg-color-4"></span>
                </h2>
            </div>
            <div class="row padding-10" id="allCourses">
                @if (count($randomCourse))
                    @foreach ($randomCourse as $courses)
                        <div class="col-sm-3 col-xs-12 block">
                            <div class="thumbnail thumbnailContent">
                                <a href="{{ route('elearning.courses.show', [
                                        'id' => $courses->id
                                    ]) }}">
                                    {{ Html::image($courses->picture_path, 'image', [
                                            'class' => 'img-responsive',
                                        ]) }}
                                </a>
                                <div class="caption border-color-{{ $loop->iteration }}">
                                    <h3><a href="{{ route('elearning.courses.show', [
                                            'id' => $courses->id
                                        ]) }}" class="color-{{ $loop->iteration }}">{{ $courses->name }}</a></h3>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="{{ route('elearning.category.show', [ 'id' => $courses->category->id ]) }}"><i class="fa fa-list" aria-hidden="true"></i>{{ $courses->category->name }}</a>
                                        </li>
                                    </ul>
                                    <p>{{ str_limit($courses->information, 25) }}</p>
                                    <ul class="list-inline btn-green">
                                        <li><a href="{{ route('elearning.courses.show', [
                                            'id' => $courses->category->id
                                        ]) }}" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>@lang('lang.more')</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="btnArea">
                        <a href="{{ route('elearning.category.show', $courses->category->category->id) }}" class="btn btn-primary">@lang('lang.viewmore')</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endforeach
