<!DOCTYPE html>
<html>
    <head>
        <title>@lang('lang.admin')</title>
        <meta charset="utf-8">
        {{ Html::favicon( 'templates/admin/images/favicon.ico' ) }}
        {{ Html::style('css/app.css') }}
        {{ Html::script('js/app.js') }}
        {{ Html::style('templates/admin/css/reset.css') }}
        {{ Html::style('templates/admin/css/style.css') }}
    </head>
    <body>
        <div class="row wrapper">
            <div class="left">
                <h4 class="username">@lang('lang.admin')</h4>
                <ul class="ul-list-manage">
                    <li class="li-list-manage" ><a href=""><i class="icon-cat fa fa-list-ul" aria-hidden="true"></i>@lang('lang.categories')<span class="visited"></span></a></li>
                    <li class="li-list-manage"><a href=""><i class="icon-cat fa fa-map" aria-hidden="true"></i>@lang('lang.courses')<span class="visited"></span></a></li>
                    <li class="li-list-manage"><a href=""><i class="icon-cat fa fa-user" aria-hidden="true"></i>@lang('lang.users')<span class="visited"></span></a></li>
                    <li class="li-list-manage"><a href=""><i class="icon-cat fa fa-clone" aria-hidden="true"></i>@lang('lang.lessons')<span class="visited"></span></a></li>
                    <li class="li-list-manage"><a href=""><i class="icon-cat fa fa-book" aria-hidden="true"></i>@lang('lang.tests')<span class="visited"></span></a></li>
                    <li class="li-list-manage"><a href=""><i class="icon-cat fa fa-list-alt" aria-hidden="true"></i>@lang('lang.wordlists')<span class="visited"></span></a></li>
                </ul>
            </div>
            <div class="right">
                <div class="header row">
                    <h2 class="col-sm-3 title-manage"><a href="">@lang('lang.manage')</a></h2>
                    <div class="user-log col-sm-2 col-sm-offset-7">
                    <ul class="ul-user-log">
                        <li class="li-user-log"><a href=""><i class="fa fa-power-off"></i>  @lang('lang.logout')</a></li>
                    </ul>
                </div>
                <div class="clr"></div>
                <!--end header-->
