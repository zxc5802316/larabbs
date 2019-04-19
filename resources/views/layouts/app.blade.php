<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', setting('seo_description', '筱龙blog 社区。'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', '筱龙blog,社区,论坛,开发者论坛'))" />

    <title>@yield('title', '筱龙blog') - {{ setting('site_name', '筱龙blog') }}</title>
    {{--style--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body>
<div class="{{route_class()}}-page" id="app">

    @include('layouts._header')

    <div class="container">

        @include('shared._messages')
        @yield('content')

    </div>

    @include('layouts._footer')
</div>
@if (app()->isLocal())
    @include('sudosu::user-selector')
@endif

<!-- Scripts -->
{{--script--}}
<script src="{{ mix('js/app.js') }}"></script>
{{--<script src="{{ asset('plugins/pjax/pjax.js') }}"></script>--}}
{{--<link rel="stylesheet" href="{{ asset('plugins/pjax/pjax.css') }}">--}}
@yield("scripts")
</body>
</html>