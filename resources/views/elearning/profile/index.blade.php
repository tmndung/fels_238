@extends('templates.elearning.master')

@section('content')
    <div class="info-errors" id="info-errors">
        @include ('common.errors')
    </div>
    <div class="background-user">
        {{ Html::image($user->background_path, '', ['class' => 'bg-img']) }}
        {{ Html::image($user->avatar_path, '', ['class' => 'avatar-user']) }}
        <div class="username-user">{{ $user->name }}</div>
        <div class="row div-info">
            <div class="div-info-bg col-sm-3">
                <span class="span-info-bg">{{ count($followings) }}</span>
                <a class="a" href="#following">@lang('lang.following')</a>
            </div>
            <div class="div-info-bg col-sm-3">
                <span class="span-info-bg">{{ count($followers) }}</span>
                <a href="#follower">@lang('lang.follower')</a>
            </div>
            <div class="div-info-bg col-sm-3">
                <span class="span-info-bg">{{ $user->studies()->count() }}</span>
                <a href="#courses">@lang('lang.course')</a>
            </div>
        </div>
        <div class="div-edit">
            @if ($user == Auth::user())
                <a href="{{ route('elearning.profile.edit', $user->id) }}" class="button-edit">
                    <span class="fa fa-pencil">&nbsp;</span>@lang('lang.editprofile')
                </a>
            @else
                @if (Auth::user()->follows->contains('user_follow_id', $user->id))
                    <a href="{{ route('elearning.profile.unfollow', $user->id) }}" class="button-edit">
                        <span class="fa fa-user-times">&nbsp;</span>@lang('lang.unfollow')
                    </a>
                @else
                    <a href="{{ route('elearning.profile.addfollow', $user->id) }}" class="button-edit">
                        <span class="fa fa-user-plus">&nbsp;</span>@lang('lang.follow')
                    </a>
                @endif
            @endif
        </div>
    </div>
    
    <section class="mainContent full-width clearfix bg-color-gray">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <aside>
                        <div class="rightSidebar">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-color-1 border-color-1">
                                    <h3 class="panel-title">@lang('lang.featured_courses')</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="media-list blogListing">
                                      @foreach ($courses as $course)
                                          <li class="media">
                                            <div class="media-left">
                                                <a href="{{ route('elearning.courses.show', $course->id) }}">{{ Html::image($course->picture_path, 'images', ['class' => 'img-rounded']) }}</a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="{{ route('elearning.courses.show', $course->id) }}">{{ $course->name }}</a></h4>
                                            </div>
                                          </li>
                                      @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="teachersInfo bg-color-gray-border">
                        <h3>@lang('lang.information')</h3>
                        <p>
                            {{ $user->description ? $user->description : trans('lang.description') }}
                        </p>
                        <ul class="list-inline">
                            <li><a href="#" class="bg-color-1"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="bg-color-2"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="bg-color-3"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div> 
                    <div class="teachersInfo bg-color-gray-border" id="courses">
                        <h3>@lang('lang.course_is_learning')</h3>
                        <div class="row padding-10 ourcourses" id="#ourcourses">
                            @if (count($studies))
                                @foreach ($studies as $key => $study)
                                    <div class="col-sm-4 col-xs-12 block {{ $key < config('setting.max_course') ? '' : 'displaynone' }}">
                                        <div class="thumbnail thumbnailContent">
                                            <div class="caption border-color-1">
                                                <h3><a href="{{ route('elearning.courses.show', $study->course->id) }}" class="color-1">{{ $study->course->name }}</a></h3>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-list" aria-hidden="true"></i><a href="{{ route('elearning.category.show', $study->course->category->id) }}">{{ str_limit($study->course->category->name, 20) }}</a></li>
                                                </ul>
                                                <p></p>
                                                <ul class="list-inline btn-yellow margin-bottom-none">
                                                    <li><a href="{{ route('elearning.courses.show', $study->course->id) }}" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>@lang('lang.view')</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if (count($studies) > config('setting.max_course'))
                                    <a href="" class="show-more"><i name="fa fa-angle-double-up" id="icon-more" class="fa fa-angle-double-down" aria-hidden="true"></i><span> </span>@lang('lang.more')</a>
                                @endif
                            @else
                                <h4>@lang('lang.not_study_any_course')</h4>
                            @endif
                        </div>
                    </div>
                    <div class="teachersInfo bg-color-gray-border" id="following">
                        <h3>@lang('lang.following')</h3>
                        <div>
                            <ul class="row user-follow">
                                @if (count($followings))
                                    @foreach ($followings as $key => $following)
                                        <li class="{{ $key < config('setting.max_user') ? '' : 'displaynone' }} col-sm-3 col-xs-12 view-follow top-user top-user-small" id="li{{ $following->id }}">
                                            {{ Html::image($following->user->avatar_path, '', ['class' => 'img-border img-circle-small']) }}
                                            <h3 class="name-small h3-small"><a href="{{ route('elearning.profile.show', $following->userFollow->id) }}">{{ str_limit($following->userFollow->name, 10, '...') }}</a></h3>
                                            @if ($user == Auth::user())
                                                <a href="javascript:void(0)" class="btn btn-xs btn-primary btn-unfollow" id="{{ $following->id }}">@lang('lang.unfollow')</a>
                                            @endif
                                        </li>
                                    @endforeach
                                    @if (count($followings) > config('setting.max_user'))
                                        <li class="btn-user-follow-li"><a href="" class="show-more-follow"><i name="fa fa-angle-double-up" id="icon-more-li" class="fa fa-angle-double-down" aria-hidden="true"></i><span> </span>@lang('lang.more')</a></li>
                                    @endif
                                @else
                                    <h4>@lang('lang.not_following_anyone')</h4>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="teachersInfo bg-color-gray-border margin-top-50px" id="follower">
                        <h3>@lang('lang.follower')</h3>
                        <div>
                            <ul class="row user-follow">
                                @if (count($followers))
                                    @foreach ($followers as $key => $follower)
                                        <li class="{{ $key < config('setting.max_user') ? '' : 'displaynone' }} col-sm-3 col-xs-12 view-follow top-user top-user-small">
                                            {{ Html::image($follower->user->avatar_path, '', ['class' => 'img-border img-circle-small']) }}
                                            <h3 class="name-small h3-small"><a href="{{ route('elearning.profile.show', $follower->user_id) }}">{{ str_limit($follower->user->name, 10, '...') }}</a></h3>
                                            @if ($user == Auth::user())
                                                @if ($follower->status)
                                                    <a href="javascript:void(0)" class="btn-follow btn-follow-small btn-block-follow" id="{{ $follower->id }}">@lang('lang.block')</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn-follow btn-block-follow" id="{{ $follower->id }}">@lang('lang.unblock')</a>
                                                @endif
                                            @endif
                                        </li>
                                    @endforeach
                                    @if (count($followers) > config('setting.max_user'))
                                        <li class="btn-user-follow-li"><a href="" class="show-more-follow"><i name="fa fa-angle-double-up" id="icon-more-li" class="fa fa-angle-double-down" aria-hidden="true"></i><span> </span>@lang('lang.more')</a></li>
                                    @endif
                                @else
                                    <h4>@lang('lang.not_follower')</h4>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
