<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <title>@yield('title')</title>
    {{-- <link rel="stylesheet" href="{{mix('webpack/vendors.css')}}"> --}}
    <link rel="stylesheet" href="{{mix('webpack/app.css')}}">
</head>
<body>
<div class="wrapper" id="app">
    <div class="content">
        @include('layouts.header')
        <main class="main">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
</div>
<script src="{{mix('webpack/manifest.js')}}" async defer></script>
<script src="{{mix('webpack/vendors.js')}}" async defer></script>
<script src="{{mix('webpack/app.js')}}" async defer></script>
</body>
</html>
