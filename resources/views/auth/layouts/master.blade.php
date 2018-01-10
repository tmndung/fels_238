<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    {{ Html::favicon('templates/admin/images/favicon.ico') }}
    {{ Html::style('css/app.css') }}
    {{ Html::script('js/app.js') }}
    {{ Html::style('templates/elearning/css/style.css') }}
</head> 
<body>
    <div>
        @yield ('content')    
    </div>
</body>
</html>
