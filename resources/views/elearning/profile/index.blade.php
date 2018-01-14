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
                <span class="span-info-bg">0</span>
                <a href="">@lang('lang.word')</a>
            </div>
            <div class="div-info-bg col-sm-3">
                <span class="span-info-bg">0</span>
                <a href="">@lang('lang.point')</a>
            </div>
        </div>
        @if ($user == Auth::user())
            <div class="div-edit">
                <a href="{{ route('elearning.profile.edit', $user->id) }}" class="button-edit">
                <span class="fa fa-pencil"></span>@lang('lang.editprofile')
                </a>
            </div>
        @endif
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
                                                <a href="#">{{ Html::image($course->picture_path, 'images', ['class' => 'img-rounded']) }}</a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#">{{ $course->name }}</a></h4>
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
                    <div class="teachersInfo bg-color-gray-border">
                        <h3>@lang('lang.course_is_learning')</h3>
                        <div class="row padding-10" id="#ourcourses">
                            @if (count($studies))
                                @foreach ($studies as $study)
                                    <div class="col-sm-4 col-xs-12 block">
                                        <div class="thumbnail thumbnailContent">
                                            <div class="caption border-color-1">
                                                <h3><a href="" class="color-1">{{ $study->course->name }}</a></h3>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-list" aria-hidden="true"></i>@lang('lang.course')</li>
                                                </ul>
                                                <p></p>
                                                <ul class="list-inline btn-yellow">
                                                    <li><a href="" class="btn btn-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>@lang('lang.viewmore')</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h4>@lang('lang.not_study_any_course')</h4>
                            @endif
                        </div>
                    </div>
                    <div class="teachersInfo bg-color-gray-border" id="following">
                        <h3>@lang('lang.following')</h3>
                        <div>
                        <ul>
                            @if (count($followings))
                                @foreach ($followings as $following)
                                    <li class="view-follow top-user top-user-small" id="li{{ $following->id }}">
                                        <img src="/templates/admin/images/avatar.jpg" alt="img" class="img-border img-circle-small">
                                        <h3 class="name-small h3-small"><a href="{{ route('elearning.profile.show', $following->id) }}">{{ str_limit($following->userFollow->name, 10, '...') }}</a></h3>
                                        @if ($user == Auth::user())
                                            <a href="javascript:void(0)" class="btn btn-xs btn-primary btn-unfollow" id="{{ $following->id }}">@lang('lang.unfollow')</a>
                                        @endif
                                    </li>
                                @endforeach

                            @else
                                <h4>@lang('lang.not_following_anyone')</h4>
                            @endif
                        </ul>
                        </div>
                    </div>

                    <div class="teachersInfo bg-color-gray-border margin-top-50px" id="follower">
                        <h3>@lang('lang.follower')</h3>
                        <div>
                        <ul>
                            @if (count($followers))
                                @foreach ($followers as $follower)
                                    <li class="view-follow top-user top-user-small">
                                        <img src="/templates/admin/images/avatar.jpg" alt="img" class="img-border img-circle-small">
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
