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
                - choose for save
            </span>
            <span>
                <i class="fa-solid fa-trash">
                </i>
                - choose for delete
            </span>
        </div>
        <div class="main-table__nav-right">
            <span>Confirm</span>
            <button type="button" value="delete" class="main-table__input main-table__nav-filter"
                form="filter-form">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>
    <div class="main-table__bets">
        
    </div>
@endsection

@section('filters-content')
    <div class="filters__options">
        <span class="filters__header">Filters</span>
        <div class="filters__stats">
            <div class="filters__box">
                <div class="filters__list-wrapper">
                <form action="/valuebets/filter" method="post" name="right-filters-form">
                    @csrf
                <div class="filters__list-box">
                    <input type="checkbox" class="none" id="filters-bets">
                    <label for="filters-bets">
                        <div class="filters__list-header">
                            <i class="fa-solid fa-caret-right filters__list-caret"></i>
                            <span class="filters__list-header-text">
                                Bets type
                            </span>
                        </div>
                    </label>
                    <ul class="filters__list">
                        <li class="filters__list-option">
                            <label>
                                <input type="checkbox" name="type['corners']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    corners
                                </span>
                            </label>
                        </li>
                        <li class="filters__list-option">
                            <label>
                                <input type="checkbox" name="type['cards']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    cards
                                </span>
                            </label>
                        </li>
                        <li class="filters__list-option">
                            <label>
                                <input type="checkbox" name="type['fouls']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    fouls
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
                                <input type="checkbox" name="sport['football']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    football
                                </span>
                            </label>
                        </li>
                        <li class="filters__list-option">
                            <label>
                                <input type="checkbox" name="sport['basketball']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    basketball
                                </span>
                            </label>
                        </li>
                        <li class="filters__list-option">
                            <label>
                                <input type="checkbox" name="sport['tennis']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    tennis
                                </span>
                            </label>
                        </li>
                        <li class="filters__list-option">
                            <label>
                                <input type="checkbox" name="sport['esport']">
                                <span class="filters__list-text">
                                    <span class="filters__check-icon-box">
                                        <i class="fa-solid fa-check filters__check-icon"></i>
                                    </span>
                                    esport 
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
                                <input type="checkbox" name="bookies['pinnacle']">
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
                                <input type="checkbox" name="bookies['22bet']">
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
                                <input type="checkbox" name="bookies['unibet']">
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
                                <input type="checkbox" name="bookies['bet365']">
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
                                <input type="checkbox" name="bookies['william_hill']">
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
                                <input type="checkbox" name="bookies['ggbet']">
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
                                <input type="checkbox" name="bookies['cloudbet']">
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
            </div>
            <input type="submit" class="filters__button filters__filters-submit" value="Filter">
            </div>
            </form>
        </div>
        <span class="filters__header">Options</span>
        <div class="filters__stats">
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Refresh timeout</span>
                <div class="filters__refresh-wrapper">
                    <span class="filters__refresh-iter">+</span>
                    <span class="filters__refresh-num">3</span>
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