<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>La Scuola di Mocajo</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="{{ mix('css/login.css') }}">
    </head>
    <body class="">
        <div id="login" class="ui-login">
            <form class="ui-login__form form" method="post" action="{{ route('login.attempt') }}">
                {{ csrf_field() }}
                <h2 class="ui-login__title">Login</h2>
                <div class="form-group ui-login__input">
                    <label for="email">Mail</label>
                    <input type="email" name="email" class="form-control" placeholder="Email...">
                </div>
                <div class="form-group mb-4 ui-login__input">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password...">
                </div>
                <div class="form-group">
                    <button type="submit" name="button" class="btn btn-outline-black ui-login__button">Invia</button>
                </div>
            </form>
        </div>
    </body>
</html>
