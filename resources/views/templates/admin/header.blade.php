<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@lang('lang.admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes()
    {{ Html::favicon( '/templates/admin/images/favicon.ico' ) }}
    {{ Html::style('/css/app.css') }}
    {{ Html::script('/js/app.js') }}
    {{ Html::script('/templates/admin/js/script.js') }}
    {{ Html::script('/templates/admin/js/setting.js') }}
    {{ Html::script('/templates/admin/js/moment.min.js') }}
    {{ Html::script('/templates/admin/js/jquery.nicescroll.js') }}
    {{ Html::style('/templates/admin/css/style.css') }}
    {{ Html::style('/templates/admin/css/animate.min.css') }}
</head>

<body id="mimin" class="dashboard">
      <!-- start: Header -->
    <nav class="navbar navbar-default header navbar-fixed-top">
        <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
                <div class="opener-left-menu is-open">
                    <span class="top"></span>
                    <span class="middle"></span>
                    <span class="bottom"></span>
                </div>
                <a href="index.html" class="navbar-brand"> 
                    <b>@lang('lang.admin')</b>
                </a>

                <ul class="nav navbar-nav search-nav">
                    <li>
                        <div class="search">
                            <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                            <div class="form-group form-animate-text">
                                <input type="text" id='search' class="form-text" required>
                                <span class="bar"></span>
                                <label class="label-search">@lang('lang.type_to_search')</label>
                            </div>
                        </div>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right user-nav">
                    <li class="user-name"><span>@lang('lang.users')</span></li>
                    <li class="dropdown avatar-dropdown">
                        <a href="#" class="user-image"><img src="/templates/admin/images/avatar.jpg" class="img-circle avatar" alt="user name" /></a></li>
                    <li class="logout-admin"><a href=""><span class="fa fa-power-off "></span></a></li>
                </ul>
            </div>
        </div>
    </nav>
  <!-- end: Header -->
    <div class="container-fluid mimin-wrapper">

      <!-- start:Left Menu -->
        @include ('templates.admin.leftbar')
      <!-- end: Left Menu -->

    
      <!-- start: content -->
        <div id="content">
            <div class="panel box-shadow-none content-header">
                <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">{{ isset($title) ? $title : trans('lang.manage') }}</h3>
                    </div>
                </div>
            </div>
