@extends('layouts.main')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
   Valuebets
@endsection

@section('js-links')
    <script src="{{ asset('js/valuebets.js') }}" defer></script>
@endsection

@section('nav-box__left')
    <div class="nav-box__timer"></div>
@endsection

@section('main-content')
    <form id="filter-form"></form>
    <div class="main-table__nav">
        <div class="main-table__nav-left">
            <span>
                <i class="fa-solid fa-floppy-disk"></i>
                </i>
                - check for save
            </span>
            <span>
                <i class="fa-solid fa-trash">
                </i>
                - check for delete
            </span>
        </div>
        <div class="main-table__nav-right">
            <span>Filter: </span>
            <button type="button" value="delete" class="main-table__input main-table__nav-filter"
                form="filter-form">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>
    <div class="main-table__bets"></div>
@endsection

@section('filters-content')
    <div class="filters__options">
        <span class="filters__header">Filters</span>
        <div class="filters__stats">
            <div class="filters__box">
                <button class="filters__button">Filter</button>
            </div>
        </div>
        <span class="filters__header">Options</span>
        <div class="filters__stats">
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Refresh timeout</span>
                <div class="filters__refresh-wrapper">
                    <span class="filters__refresh-iter">+</span>
                    <span class="filters__refresh-num">2</span>
                    <span class="filters__refresh-iter">-</span>
                </div>
                <button class="filters__button filters__submit filters__refresh">Refresh</button>
            </div>
        </div>
        <span class="filters__header">Sorting</span>
        <div class="filters__stats">
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Sorting options</span>
                <div class="filters__sorting">
                    <div class="filters__sorting-box">
                        <div class="filters__sorting-wrapper">
                            <span class="filters__sorting-span">Delay</span>
                        </div>
                        <div class="filters__sorting-wrapper">
                            <span class="filters__sorting-span">Date</span>
                        </div>
                        <div class="filters__sorting-wrapper">
                            <span class="filters__sorting-span">Odd</span>
                        </div>
                        <div class="filters__sorting-wrapper">
                            <span class="filters__sorting-span">Value</span>
                        </div>
                    </div>
                    <div class="filters__sorting-caret-wrapper">
                        <div class="filters__sorting-caret">
                            <i title="asceding" class="fa-solid fa-caret-up filters__caret"></i>
                        </div>
                        <div class="filters__sorting-caret">
                            <i title="descending" class="fa-solid fa-caret-down filters__caret"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection