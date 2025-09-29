<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coachtech Furima</title>
    <link rel="stylesheet" href="{{ asset('css/auth/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth/common_login.css') }}" />
    @yield('css')
</head>
<body class="@auth auth-logged-in @endauth">
    <div class="app">
        <header class="header">
            <a href="{{ route('products.index') }}" class="header__logo">
                <img src="{{ asset('images/logo.svg') }}" alt="サイトロゴ">
            </a>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>