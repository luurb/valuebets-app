@extends('layouts.app')

@section('content')
    <div class="nav-box">
        <div class="nav-box__left">
            @yield('nav-box-content')
            <div class="nav-box__filters-icon hide-filters">
                <i class="fas fa-cog"></i>
            </div>
        </div>
    </div>
    <section class="main-section">
        <section class="main-table">
            <div class="main-table__wrapper">
                @yield('main-content')
            </div>
        </section>
        <section class="filters">
            @yield('filters-content')
        </section>
    </section>
@endsection