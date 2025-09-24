<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coachtech Furima</title>
    <link rel="stylesheet" href="{{ asset('css/auth/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth/common.css') }}" />
    @yield('css')
</head>
<body>
    <header class="header">
        <a href="{{ route('products.index') }}" class="header__logo">
            <img src="{{ asset('images/logo.svg') }}" alt="サイトロゴ">
        </a>

        <div class="header__search">
            <form class="header__search-form" action="{{ route('products.index') }}" method="get">
                <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{request('keyword')}}">
                <input type="hidden" name="tab" value="{{ request('tab', 'recommend') }}">
            </form>
        </div>

        <div class="header__link-grid">
            @guest
                <a class="header__link-login" href="/login">ログイン</a>
            @endguest
            @auth
                <form class="header__link-logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="header__link-logout" type="submit">ログアウト</button>
                </form>
            @endauth

            <a class="header__link" href="/mypage">マイページ</a>
            <a class="header__link header__link-sell" href="/sell">出品</a>
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>