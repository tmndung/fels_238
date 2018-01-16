<!DOCTYPE html>
<html style="overflow: hidden;">
<head>
    <title>@lang('lang.test')</title>
    <meta charset="utf-8">
    @routes
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ Html::favicon('templates/admin/images/favicon.ico') }}
    {{ Html::style('css/app.css') }}
    {{ Html::script('js/app.js') }}
    {{ Html::script('templates/elearning/js/script.js') }}
    {{ Html::style('templates/elearning/css/style.css') }}
    {{ Html::style('/templates/admin/css/animate.min.css') }}
    @yield ('init')
</head>
<body>
    @yield ('content')
</body>
</html>
