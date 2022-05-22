@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <section class="home">
        <div class="home__text-wrapper">
            <div class="home__main-text">Bet thousands of
                <span class="home__main-text-green">
                    free valuebets
                </span>
            </div>
            <div class="home__desc">
                Use free valuebets finder and tools for making money on betting.
            </div>
            <div class="home__button">
                <a href="/valuebets">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Find valuebets
                </a>
            </div>
        </div>
    </section>
@endsection