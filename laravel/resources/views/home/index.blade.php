@extends('layouts.app')

@section('description')
    Bet for free with valuebets finder and use tools for making money with betting.
@endsection

@section('title')
    Home
@endsection

@section('content')
    <section class="home">
        <div class="home__text-wrapper">
            <h1 class="home__main-text">Bet thousands of
                <span class="home__main-text-green">
                    free valuebets
                </span>
            </h1>
            <p class="home__desc">
                Use free valuebets finder and tools for making money on betting.
            </p>
            <div class="home__button">
                <a href="/valuebets">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Find valuebets
                </a>
            </div>
        </div>
    </section>
@endsection