<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $seo->title }}</title>
        <meta name="description" content="{{ $seo->description }}" />

        <meta property="og:title" content="{{ $seo->title }}">
        <meta property="og:description" content="{{ $seo->description }}">
        <meta property="og:image" content="{{ $seo->image }}">
        <meta property="og:url" content="{{ $seo->current_url }}">

        <meta name="twitter:title" content="{{ $seo->title }}">
        <meta name="twitter:description" content="{{ $seo->description }}">
        <meta name="twitter:image" content=" {{ $seo->image }}">
        <meta name="twitter:card" content="summary_large_image">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134799170-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-134799170-1');
        </script>
    </head>
    <body>
        <div id="app">
            <main-template
                cities="{{ $cities }}"
                options="{{ $options }}"
                products="{{ $products }}">
            </main-template>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
