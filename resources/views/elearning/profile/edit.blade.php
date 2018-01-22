@extends('templates.elearning.master')

@section('content')
    <div class="info-errors" id="info-errors">
        @include ('common.errors')
    </div>
    <div class="bg-color-gray">
        <section class="pageTitleSection">
          <div class="container">
            <div class="pageTitleInfo">
              <h2>@lang('lang.editprofile')</h2>
              <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">@lang('lang.home')</a></li>
                <li><a href="{{ route('elearning.profile.show', $user->id) }}">@lang('lang.profile')</a></li>
                <li class="active">@lang('lang.editprofile')</li>
              </ol>
            </div>
          </div>
        </section>
        <div class="container margin-top-50px margin-bottom-50px">
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
                <div class="col-xs-9">
                    <div class="bg-color-blue setting-profile">
                        <h3 class="title-edit-profile">@lang('lang.setting')</h3>
                        <a href="javascript:void(0)" class="actived" id="edit-user">@lang('lang.profile_lower')</a>
                        <a href="javascript:void(0)" id="edit-password">@lang('lang.password')</a>
                    </div>
                    <div class="bg-color-white-border">
                        <div class="homeContactContent edit-user">
                            {{ Form::open(['route' => ['elearning.profile.update', $user->id], 'files' => 'true']) }}
                                {{ method_field('PUT') }}
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label(trans('lang.changeUsername'), '', [
                                                'class' => 'edit-profile',
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <i class="fa fa-user"></i>
                                            {{ Form::text('name', $user->name, [
                                                'class' => 'form-control border-color-2',
                                                'placeholder' => trans('lang.fullname'),
                                                'id' => 'name-edit-profile'
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label(trans('lang.changeAvatar'), '', [
                                                'class' => 'edit-profile',
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::file('avatar', [
                                                'class' => 'form-control border-color-3',
                                                'id' => 'avatar-edit-profile'
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label(trans('lang.changeBackground'), '', [
                                                'class' => 'edit-profile',
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::file('background', [
                                                'class' => 'form-control border-color-5',
                                                'id' => 'bg-edit-profile'
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="formBtnArea">
                                            {{ Form::button(trans('lang.save'), [
                                                'class' => 'btn btn-primary',
                                                'type' => 'submit',
                                                'id' => 'btn-edit-profile'
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="homeContactContent edit-password">
                            {{ Form::open(['route' => ['elearning.profile.updatepassword'], 'files' => 'true', 'method' => 'POST']) }}
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label(trans('lang.changePassword'), '', [
                                                'class' => 'edit-profile',
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::password('newpassword', [
                                                'class' => 'form-control border-color-5',
                                                'placeholder' => trans('lang.changePassword'),
                                                ])
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label(trans('lang.confirmPassword'), '', [
                                                'class' => 'edit-profile',
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::password('confirmpassword', [
                                                'class' => 'form-control border-color-4',
                                                'placeholder' => trans('lang.confirm'),
                                                ])
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="formBtnArea">
                                            {{ Form::button(trans('lang.save'), [
                                                'class' => 'btn btn-primary',
                                                'type' => 'submit',
                                                ]) 
                                            }}
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
