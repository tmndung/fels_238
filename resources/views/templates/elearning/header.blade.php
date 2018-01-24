<!DOCTYPE html>
<html>
    <head>
        <title>@lang('lang.title')</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @routes
        {{ Html::favicon('templates/admin/images/favicon.ico') }}
        {{ Html::style('css/app.css') }}
        {{ Html::script('js/app.js') }}

        {{ Html::script('templates/elearning/js/jquery-min.js') }}
        {{ Html::script('templates/elearning/js/jquery.selectbox-0.1.3.min.js') }}
        {{ Html::script('templates/elearning/js/jquery.themepunch.tools.min.js') }}
        {{ Html::script('templates/elearning/js/jquery.themepunch.revolution.min.js') }}
        {{ Html::script('templates/elearning/js/script.js') }}
        
        {{ Html::style('templates/elearning/css/default.css') }}
        {{ Html::style('/templates/admin/css/animate.min.css') }}
        {{ Html::style('templates/elearning/css/style2.css') }}
        {{ Html::style('templates/elearning/css/style.css') }}
        {{ Html::style('templates/elearning/css/settings.css') }}
        {{ Html::style('/templates/admin/css/animate.min.css') }}
    </head>
    <body>
        <header id="pageTop" class="header-wrapper">
            <!-- COLOR BAR -->
            <div class="container-fluid color-bar top-fixed">
                <div class="row">
                    <div class="col-sm-1 col-xs-2 bg-color-1"></div>
                    <div class="col-sm-1 col-xs-2 bg-color-2"></div>
                    <div class="col-sm-1 col-xs-2 bg-color-3"></div>
                    <div class="col-sm-1 col-xs-2 bg-color-4"></div>
                    <div class="col-sm-1 col-xs-2 bg-color-5"></div>
                    <div class="col-sm-1 col-xs-2 bg-color-6"></div>
                    <div class="col-sm-1 bg-color-1 hidden-xs"></div>
                    <div class="col-sm-1 bg-color-2 hidden-xs"></div>
                    <div class="col-sm-1 bg-color-3 hidden-xs"></div>
                    <div class="col-sm-1 bg-color-4 hidden-xs"></div>
                    <div class="col-sm-1 bg-color-5 hidden-xs"></div>
                    <div class="col-sm-1 bg-color-6 hidden-xs"></div>
                </div>
            </div>
            <div class="top-info-bar bg-color-7 hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <ul class="list-inline support">
                                <li><a href="">@lang('lang.introduce')</a></li>
                                <li><a href="">@lang('lang.Q_A')</a></li>
                                <li><a href="">@lang('lang.support')</a></li>
                                <li><a href="">@lang('lang.contact')</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            {!! Form::open(['class' => 'search-public']) !!}
                                <div class="input-group button-search">
                                    {!! Form::text('text', '', ['class' => 'form-control', 'id' => 'search-text']) !!}
                                    <span class="input-group-btn">
                                        <i class="fa fa-search btn btn-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                            {!! Form::close() !!}
                            <div class="content-search"></div>
                        </div>
                        <div class="col-sm-4">
                            <ul class="list-inline functionList">
                                <li><i class="fa fa-globe bg-color-4" aria-hidden="true"></i></li>
                                <li class="LanguageList">
                                    {!! Form::open(['url' => '', 'class' => 'bg-color-4', 'id' => 'language-form']) !!}
                                        {!! Form::select('select-language', ['en' => trans('lang.english'), 'vi' => trans('lang.vietnamese')], config('app.locale'), ['id' => 'select-language', 'class' => 'select-language']); !!}
                                    {!! Form::close() !!}
                                </li>
                                    @auth
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                                <span><img src="{{ Auth::user()->avatar_path }}" class="avatar"></span>
                                                {{ str_limit(Auth::user()->name, 7) }} <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('elearning.profile.index') }}">@lang('lang.my_profile')</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        @lang('lang.logout')
                                                    </a>
                                                    {{ Form::open(['route' => 'logout', 'id' => 'logout-form']) }}
                                                    {{ Form::close() }}
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li class="login-register"><i class="fa fa-unlock-alt bg-color-5" aria-hidden="true"></i>
                                        <a href="{{ route('login') }}">@lang('lang.login')</a>|
                                        <a href="{{ route('register') }}">@lang('lang.register')</a>
                                    @endauth
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <div>
                <nav id="menuBar" class="menuBar-fix navbar navbar-default lightHeader" role="navigation">
                    <div class="row">
                        <div class="col-sm-4 img-logo">
                            <a href="{{ route('home') }}"><img src="{{ config('setting.logo') }}"></a>
                        </div>
                        <div class="col-sm-6 menuBar-header">
                            <ul class="category-menu">
                                <li>
                                    <a href="{{ route('home') }}">
                                        <i class="fa fa-home home-icon bg-color-4" aria-hidden="true"></i>
                                        <span class="color-4">@lang('lang.home')</span>
                                    </a>
                                </li>
                                @foreach ($shareCategories as $category)
                                    <li class="category-li">
                                        <a href="{{ route('elearning.category.show', $category->id) }}" class="category">
                                            <i class="fa fa-list-ol bg-color-{{ $loop->iteration }}" aria-hidden="true"></i>
                                            <span class="color-{{ $loop->iteration }}">{{ $category->name }}</span>
                                        </a>
                                        <ul class="category-subcategory category-subcategory-{{ $loop->iteration }}">
                                            @foreach ($category->categories as $subCategory)
                                                <li>
                                                    <a href="{{ route('elearning.category.show', $subCategory->id) }}">{{ $subCategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="clr"></div>
                </nav>
            </div>
        </header>
