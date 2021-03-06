@extends('layouts.app')

@section('touch')
    ontouchstart    
@endsection

@section('content')
    <div class="nav-box">
        <div class="nav-box__box-wrapper">
            <div class="nav-box__box">
                <div class="nav-box__left">
                    @yield('nav-box__left')
                    <div class="nav-box__filters-icon hide-filters">
                        <i class="fas fa-cog"></i>
                    </div>
                </div>
                @yield('nav-box-content')
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
            <div class="filters__options">
                <div class="filters__options-box">
                    @yield('filters-content')
                </div>
            </div>
        </section>
    </section>
@endsection