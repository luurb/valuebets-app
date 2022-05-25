<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    @yield('js-links')
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }} type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('/favicon_180x180.png') }} sizes="180x180">
    <link rel="icon" href="{{ asset('/favicon_32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('/favicon_48x48.png') }}" sizes="48x48">
    <link rel="icon" href="{{ asset('/favicon_96x96.png') }}" sizes="96x96">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <title>@yield('title') - Free Valuebets</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <meta name="description" content="@yield('description')">
    <meta property="og:description" content="@yield('description')">

</head>
<body @yield('touch')>
    <nav class="nav">
        <div class="nav__logo"><a href="/home"><span class="nav__first-logo">Value</span><span class="nav__seclogo">scrape</span></a></div>
        <input type="checkbox" id="nav-check" class="none">
        <label for="nav-check" class="nav__label nav__label--nav none">
            <i class="fas fa-bars"></i>
        </label>
        <div class="nav__wrapper">
            <div class="nav__left-nav">
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><a class="active" href="/valuebets">Valuebets</a></li>
                    <li><a href="/history">Bets history</a></li>
                    <li><a href="/add">Add bet</a></li>
                    <li><a href="/tools">Tools</a></li>    
                </ul>
            </div>
            <input type="checkbox" id="user-check" class="none">
            <label for="user-check" class="nav__label nav__label--user none">
                <i class="fas fa-bars"></i>
            </label>
            <div class="nav__right-nav">
                <ul>
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                                class="nav__avatar" alt="account avatar"/>
                                {{ auth()->user()->name }}
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                               <button type="submit" class="nav__logout-button"><i class="fa-solid fa-right-to-bracket"></i>Log out</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>Login</a></li>
                        <li><a href="{{ route('register') }}" id="nav__singup-button"><i class="fas fa-user-plus"></i>Register</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__top flex">
            <ul class="flex">
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Tutorials</a></li>
            </ul>
        </div>
        <div class="footer__bottom">
            &copy 2021-2022 Valuescrap
        </div>
    </footer>  
</body>
</html>
