@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="nav-box">
            @yield('nav-box-content')
        </div>
        <section class="main-table">
            <div class="main-table__wrapper">
                @yield('main-content')
            </div>
        </section>
        <section class="filters">
            @yield('filters-content')
        </section>
    </main>
@endsection