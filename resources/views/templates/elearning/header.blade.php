<!DOCTYPE html>
<html>
    <head>
        <title>@lang('lang.title')</title>
        <meta charset="utf-8">
        {{ Html::style('css/app.css') }}
        {{ Html::script('js/app.js') }}
        {{ Html::script('templates/elearning/js/script.js') }}
        {{ Html::style('templates/elearning/css/style.css') }}
    </head>
    <body>
        <header id="pageTop" class="header-wrapper">
            <!-- COLOR BAR -->
            <div class="color-bar top-fixed">
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
            <div class="top-info-bar">
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
                            {!! Form::open(array('url' => '')) !!}
                                <div class="input-group button-search">
                                    {!! Form::text('text', '', array('class' => 'form-control')) !!}
                                    <span class="input-group-btn">
                                        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default', 'type' => 'submit')) !!}
                                    </span>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-sm-4">
                            <ul class="list-inline functionList">
                                <li><i class="fa fa-globe bg-color-4" aria-hidden="true"></i></li>
                                <li class="LanguageList">
                                    {!! Form::open(array('url' => '', 'class' => 'bg-color-4')) !!}
                                        {!! Form::select('select-language', ['English' => trans('lang.english'), 'Vietnamese' => trans('lang.vietnamese')], null, array('id' => 'select-language', 'class' => 'select-language')); !!}
                                    {!! Form::close() !!}
                                </li>
                                <li><i class="fa fa-unlock-alt bg-color-5" aria-hidden="true"></i> <a href='#loginModal' data-toggle="modal" >@lang('lang.login')</a><span>|</span><a href='#createAccount' data-toggle="modal">@lang('lang.register')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <div>
                <nav id="menuBar" class="navbar navbar-default" role="navigation">
                    <div class="row">
                        <div class="col-sm-4 img-logo">
                            <a href=""><img src="templates/elearning/images/logo.png"></a>
                        </div>
                        <div class="col-sm-6 menuBar-header">
                            <ul class="category-menu">
                                <li>
                                    <a href="">
                                        <i class="fa fa-home home-icon orange-background" aria-hidden="true"></i>
                                        <span class="orange-text">@lang('lang.home')</span>
                                    </a>
                                </li>
                                <li class="category-li">
                                    <a href="" class="category">
                                        <i class="fa fa-bars blue-background" aria-hidden="true"></i>
                                        <span class="blue-text">@lang('lang.categories')</span>
                                    </a>
                                    <ul class="category-subcategory">
                                        <li><a href="">@lang('lang.categories')</a></li>
                                        <li><a href="">@lang('lang.categories')</a></li>
                                        <li><a href="">@lang('lang.categories')</a></li>
                                        <li><a href="">@lang('lang.categories')</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-user-circle-o pink-background" aria-hidden="true"></i>
                                        <span class="pink-text">@lang('lang.profile')</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-list-ol green-background" aria-hidden="true"></i>
                                        <span class="green-text">@lang('lang.rank')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clr"></div>
                </nav>
            </div>
        </header>
