<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>CutCode</title>
    <meta name="description" content="Видеокурс по изучению принципов программирования">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    {{--	<link rel="apple-touch-icon" sizes="180x180" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/apple-touch-icon.png', null) }}">--}}
    {{--	<link rel="icon" type="image/png" sizes="32x32" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/favicon-32x32.png', null) }}">--}}
    {{--	<link rel="icon" type="image/png" sizes="16x16" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/favicon-16x16.png', null) }}">--}}
    {{--	<link rel="mask-icon" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/safari-pinned-tab.svg', null) }}" color="#1E1F43">--}}
    <meta name="msapplication-TileColor" content="#1E1F43">
    <meta name="theme-color" content="#1E1F43">
    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body x-data="{ 'showTaskUploadModal': false, 'showTaskEditModal': false }" x-cloak>

<!-- Site header -->
<header class="header pt-6 xl:pt-12">
    <div class="container">
        <div class="header-inner flex items-center justify-between lg:justify-start">
            <div class="header-logo shrink-0">
                <a href="index.html" rel="home">
                    <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.svg', null) }}"
                         class="w-[120px] xs:w-[148px] md:w-[201px] h-[30px] xs:h-[36px] md:h-[50px]" alt="CutCode">
                </a>
            </div><!-- /.header-logo -->

            @include('parts.nav')

        </div><!-- /.header-inner -->
    </div><!-- /.container -->
</header>
