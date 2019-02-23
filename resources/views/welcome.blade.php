<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La Scuola di Mocajo</title>
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
                cities="{{ $cities }}">
            </main-template>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
