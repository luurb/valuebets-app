<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="nav flex">
        <div class="nav__logo"><a href="/valuebets">Value<span class="nav__seclogo">scrap</span></a></div>
        <input type="checkbox" id="nav-check" class="none">
        <label for="nav-check" class="nav__label nav__label--nav none">
            <i class="fas fa-bars"></i>
        </label>
        <div class="nav__wrapper">
            <div class="nav__left-nav">
                <ul>
                    <li><a class="active" href="/valuebets">Valuebets</a></li>
                    <li><a href="/history">Bet history</a></li>
                    <li><a href="/add">Add bet</a></li>
                    <li><a href="/"> Tutorials</a></li>    
                </ul>
            </div>
            <input type="checkbox" id="user-check" class="none">
            <label for="user-check" class="nav__label nav__label--user none">
                <i class="fas fa-bars"></i>
            </label>
            <div class="nav__right-nav">
                <ul>
                    <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i>Sing up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')


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
