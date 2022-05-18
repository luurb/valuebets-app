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
            <span class="main-table__nav-info">
                <i class="fa-solid fa-circle-info"></i>
            </span>
            <div class="main-table__nav-info-list">
                <span>
                    <i class="fa-solid fa-floppy-disk"></i>
                    </i>
                    - choose for save
                </span>
                <span>
                    <i class="fa-solid fa-trash">
                    </i>
                    - choose for delete
                </span>
                <span>
                    <i class="fa-solid fa-filter">
                    </i>
                    - confirm selections
                </span>
            </div>
        </div>
        <div class="main-table__nav-right">
            <button type="button" value="delete" 
            class="main-table__input main-table__nav-filter" form="filter-form">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>
    <div class="main-table__bets">
        
    </div>
@endsection

@section('filters-content')
    <span class="filters__header">Filters</span>
    @error('filtersErrorMessage')
        <div class="filters__error error-text">{{ $message }}</div> 
    @enderror
    <div class="filters__stats">
        <form action="/valuebets/filter" method="post" name="right-filters-form">
            @csrf
            <div class="filters__box">
                <div class="filters__filters-wrapper">
                    <div class="filters__list-box">
                        <input type="checkbox" class="none" id="filters-bets">
                        <label for="filters-bets">
                            <div class="filters__list-header">
                                <i class="fa-solid fa-caret-right filters__list-caret"></i>
                                <span class="filters__list-header-text">
                                    Hide bets 
                                </span>
                            </div>
                        </label>
                        <ul class="filters__list">
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="type[corner]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('corner', Session::get('filters')['type']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Corners
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="type[card]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('card', Session::get('filters')['type']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Cards
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="type[foul]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('foul', Session::get('filters')['type']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Fouls
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="type[offside]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('offside', Session::get('filters')['type']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Offsides
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="type[shot]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('shot', Session::get('filters')['type']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Shots
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="type[period]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('period', Session::get('filters')['type']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Period
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filters__list-box">
                        <input type="checkbox" class="none" id="filters-sports">
                        <label for="filters-sports">
                            <div class="filters__list-header">
                                <i class="fa-solid fa-caret-right filters__list-caret"></i>
                                <span class="filters__list-header-text">
                                    Sports
                                </span>
                            </div>
                        </label>
                        <ul class="filters__list">
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="sport[football]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('football', Session::get('filters')['sport']))
                                                checked
                                            @endif
                                        @else 
                                            checked
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Football
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="sport[basketball]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('basketball', Session::get('filters')['sport']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Basketball
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="sport[tennis]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('tennis', Session::get('filters')['sport']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Tennis
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="sport[esport]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('esport', Session::get('filters')['sport']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Esport 
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filters__list-box">
                        <input type="checkbox" class="none" id="filters-bookies">
                        <label for="filters-bookies">
                            <div class="filters__list-header">
                                <i class="fa-solid fa-caret-right filters__list-caret"></i>
                                <span class="filters__list-header-text">
                                    Bookies
                                </span>
                            </div>
                        </label>
                        <ul class="filters__list">
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[pinnacle]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('pinnacle', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @else 
                                            checked
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Pinnacle
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[22bet]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('22bet', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        22bet
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[unibet]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('unibet', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @else 
                                            checked
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Unibet
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[bet365]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('bet365', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @else 
                                            checked
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Bet365
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[williamhill]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('williamhill', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        William hill
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[ggbet]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('ggbet', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        GGbet
                                    </span>
                                </label>
                            </li>
                            <li class="filters__list-option">
                                <label>
                                    <input type="checkbox" name="bookies[cloudbet]"
                                        @if (Session::has('filters')) 
                                            @if (in_array('cloudbet', Session::get('filters')['bookies']))
                                                checked
                                            @endif
                                        @endif
                                    >
                                    <span class="filters__list-text">
                                        <span class="filters__check-icon-box">
                                            <i class="fa-solid fa-check filters__check-icon"></i>
                                        </span>
                                        Cloudbet
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filters__list-box">
                        <input type="checkbox" class="none" id="filters-time">
                        <label for="filters-time">
                            <div class="filters__list-header">
                                <i class="fa-solid fa-caret-right filters__list-caret"></i>
                                <span class="filters__list-header-text">
                                    Event during
                                </span>
                            </div>
                        </label>
                        <ul class="filters__list">
                            <li class="filters__list-option l-padding-0">
                                <div class="filters__time-box">
                                    <input type="hidden" name="event-during" 
                                    value="@if (Session::has('filters')){{ Session::get('filters')['time'] }}@else 6 @endif">
                                    <div class="filters__iter-wrapper">
                                        <span class="filters__iter">-</span>
                                        <span class="filters__iter-num filters__iter">
                                            @if (Session::has('filters')){{ Session::get('filters')['time'] }}@else 3 @endif
                                        </span>
                                        <span class="filters__iter">+</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <input type="submit" class="filters__button filters__filters-submit" value="Filter">
            </div>
        </form>
    </div>
    <span class="filters__header">Options</span>
    <div class="filters__stats">
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Refresh timeout</span>
            <div class="filters__refresh-box">
                <div class="filters__iter-wrapper">
                    <span class="filters__iter">-</span>
                    <span class="filters__iter-num filters__iter">3</span>
                    <span class="filters__iter">+</span>
                </div>
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
@endsection