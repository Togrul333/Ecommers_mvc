<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: @yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('admin.categories.index')}}">Админ панель</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
{{--                <li @if(\Illuminate\Support\Facades\Route::currentRouteNamed('admin.categories.index')) class="active"  @endif><a href="{{route('admin.categories.index')}}">Категории</a>--}}
                <li @routeactiv('admin.categories.index')><a href="{{route('admin.categories.index')}}">Категории</a>
                <li @if(\Illuminate\Support\Facades\Route::currentRouteNamed('admin.products.index')) class="active"  @endif><a href="{{route('admin.products.index')}}">Продукты</a>
                <li @if(\Illuminate\Support\Facades\Route::currentRouteNamed('admin.orders.index')) class="active"  @endif><a href="{{route('admin.orders.index')}}">Заказы</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @auth
{{--                    <li><a href="{{route('orders')}}">Мои заказы</a></li>--}}
                    <li><a href="{{route('logout')}}">Выйти</a></li>
                @else
                    <li><a href="{{route('login')}}">Войти</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{session()->get('success')}}</p>
        @endif
        @if(session()->has('warning'))
            <p class="alert alert-warning">{{session()->get('warning')}}</p>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
