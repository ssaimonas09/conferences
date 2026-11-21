<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.site_name')) · {{ __('messages.site_name') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script defer src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    <header class="site-header">
        <nav class="container navbar navbar-expand-md">
            <a class="navbar-brand fw-bold" href="{{ route('conferences.index') }}"><span class="brand-mark">C</span> {{ __('messages.site_name') }}</a>
            <div class="ms-auto d-flex align-items-center gap-3">
                <a class="nav-link" href="{{ route('conferences.index') }}">{{ __('messages.nav_home') }}</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-dark btn-sm" type="submit">{{ __('messages.logout') }}</button></form>
                @else
                    <a class="btn btn-dark btn-sm" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                @endauth
            </div>
        </nav>
    </header>
    <main>
        @if (session('success'))<div class="container mt-4"><div class="alert alert-success" role="status">{{ session('success') }}</div></div>@endif
        @yield('content')
    </main>
</body>
</html>
