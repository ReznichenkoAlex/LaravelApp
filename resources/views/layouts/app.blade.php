<!DOCTYPE html>
<html lang="ru">
<head>
    <title>main - ГеймсМаркет</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/css/libs.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/media.css">
</head>
<body>
<div class="main-wrapper">
   @include('layouts.header')
    <div class="middle">
        <div class="sidebar">
            @include('layouts.sidebar.category')
            @include('layouts.sidebar.news')
        </div>
        <div class="main-content">
            @include('layouts.content.top')
            @yield('content')
            @include('layouts.content.bottom')
        </div>
    </div>
    @include('layouts.footer')
</div>
<script src="/js/main.js"></script>
</body>
</html>
