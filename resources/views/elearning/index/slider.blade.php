<section class="bannercontainer bannercontainerV1">
  <div class="fullscreenbanner-container">
    <div class="fullscreenbanner">
        <ul>
            @foreach ($featuredCourses as $featuredCourse)
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
                    <img class="img-course-slider" src="{{ $featuredCourse->picture_path }}" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <div class="slider-caption container">
                        <div class="tp-caption rs-caption-1 sft start"
                          data-hoffset="0"
                          data-y="200"
                          data-speed="800"
                          data-start="1000"
                          data-easing="Back.easeInOut"
                          data-endspeed="300">
                          <a class="title-course-slider" href="{{ route('elearning.courses.show', [
                            'id' => $featuredCourse->id
                        ]) }}">{{ $featuredCourse->name }}</a>
                        </div>

                        <div class="tp-caption rs-caption-2 sft"
                          data-hoffset="0"
                          data-y="265"
                          data-speed="1000"
                          data-start="1500"
                          data-easing="Power4.easeOut"
                          data-endspeed="300"
                          data-endeasing="Power1.easeIn"
                          data-captionhidden="off">
                          {{ str_limit($featuredCourse->information, 150) }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
  </div>
</section>
<section class="clearfix linkSection hidden-xs custom-linkSection">
    <div class="sectionLinkArea hidden-xs scrolling">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-sm-3">
                    <a href="#{{ $category->name }}" class="sectionLink bg-color-{{ $category->id }}" id="coursesLink">
                        <i class="fa fa-file-text-o linkIcon border-color-{{ $category->id }}" aria-hidden="true"></i>
                        <span class="linkText">{{ str_limit($category->name, 12) }}</span>
                        <i class="fa fa-chevron-down locateArrow" aria-hidden="true"></i>
                    </a>
                </div>
            @endforeach
            <div class="col-sm-3">
                <a href="#informationCourses" class="sectionLink bg-color-4" id="newsLink">
                    <i class="fa fa-files-o linkIcon border-color-4" aria-hidden="true"></i>
                    <span class="linkText">@lang('lang.information')</span>
                    <i class="fa fa-chevron-down locateArrow" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>
