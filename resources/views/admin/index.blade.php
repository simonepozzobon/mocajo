<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La Scuola di Mocajo</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    </head>
    <body class="bg-black">
        <div id="admin">
            <main-template></main-template>
        </div>
        <script src="{{ mix('js/admin.js') }}"></script>
    </body>
</html>
