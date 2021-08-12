<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body id="bodyCbondsMain">

<div id="app">
    <div id="header" class="header">
        <div class="wrapper">
            <div class="main_menu js_main_menu">
                <ul class="list">
                    <li class="main_item">
                        <a href="{{ route('index') }}" class="item">Главная</a>
                    </li>

                    @if (empty($auth))
                    <li class="main_item" >
                        <a href="{{ route('auth') }}" class="item">Вы неавторизованы [Войти]</a>
                    </li>
                        @{{setAuth(false)}}
                    @else
                        @{{setAuth(true)}}
                    <li class="main_item auth">
                        <a href="{{ route('logout') }}" class="item">Вы авторизованы [Выйти]</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        @yield('content')
    </div>
</div>
<script>
    var labels = {};
</script>
<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
