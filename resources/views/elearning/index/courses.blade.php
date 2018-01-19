<section class="mainContent bg-index full-width clearfix featureSection pd-page-top-100">
    <div class="whiteSection bg-index pd-page-top">
        <div class="sectionTitle text-center">
            <h2>
                <span class="shape shape-left bg-color-4"></span>
                <span>@lang('lang.all_course')</span>
                <span class="shape shape-right bg-color-4"></span>
            </h2>
        </div>
        <div class="row padding-10" id="allCourses">
            @foreach ($allCourses as $allCourse)
            <div class="col-sm-3 col-xs-12 block">
                <div class="thumbnail thumbnailContent">
                    <a href="{{ route('elearning.courses.show', [
                            'id' => $allCourse->id
                        ]) }}">
                        {{ Html::image($allCourse->picture_path, 'image', [
                                'class' => 'img-responsive',
                            ]) }}
                    </a>
                    <div class="caption border-color-2">
                        <h3><a href="{{ route('elearning.courses.show', [
                                'id' => $allCourse->id
                            ]) }}" class="color-2">{{ $allCourse->name }}</a></h3>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('elearning.category.show', [ 'id' => $allCourse->category->id ]) }}"><i class="fa fa-list" aria-hidden="true"></i>{{ $allCourse->category->name }}</a>
                            </li>
                        </ul>
                        <p>{{ str_limit($allCourse->information, 30) }}</p>
                        <ul class="list-inline btn-green">
                            <li><a href="{{ route('elearning.courses.show', [
                                'id' => $allCourse->id
                            ]) }}" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>@lang('lang.more')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="btnArea">
                <a href="{{ route('elearning.category.index') }}" class="btn btn-primary">@lang('lang.viewmore')</a>
            </div>
        </div>
    </div>
</section>
