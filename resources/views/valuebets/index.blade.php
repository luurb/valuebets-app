@extends('layouts.main')

@section('title')
   Valuebets
@endsection

@section('js-links')
    <script type="module" src="{{ asset('js/fetch.js') }}" async></script>
    <script src="{{ asset('js/refresh-option.js') }}" defer></script>
    <script type="module" src="{{ asset('js/game-filter.js') }}" defer></script>
    <script type="module" src="{{ asset('js/sorting.js') }}" defer></script>
@endsection

@section('nav-box-content')
    <div class="nav-box__timer"></div>
@endsection

@section('main-content')
    <table class="main-table__table main-table__valuebets-table">
        <thead>
            <tr>
                <th scope="colgroup">Delay</th>
                <th scope="colgroup">Bookmaker</th>
                <th scope="colgroup">Sport</th>
                <th scope="colgroup">Date and time</th>
                <th scope="colgroup">Teams</th>
                <th scope="colgroup">Bet</th>
                <th scope="colgroup">Odd</th>
                <th scope="colgroup">Value</th>
                <th scope="colgroup">
                    <input type="submit" value="Add/Delete" class="main-table__button">
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>  
    </table>
@endsection

@section('filters-content')
    <input type="checkbox" id="stat-check" class="none">    
    <div class="filters__wrapper none">
        <label for="stat-check" class="filters__filters-icon" title="Show stats">
            <i class="fas fa-cog none"></i>
        </label>
    </div>
    <div class="filters__options">
        <span class="filters__header">Filters</span>
        <div class="filters__stats">
            <div class="filters__box">
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
                    <select class="filters__select">
                        <option disabled selected hidden>Choose</option>
                        <option>Delay</option>
                        <option>Date</option>
                        <option>Odd</option>
                        <option>Value</option>
                    </select>
                    <span>
                        <i title="asceding" class="fa-solid fa-caret-up filters__caret"></i>
                        <i title="descending" class="fa-solid fa-caret-down filters__caret filters__caret-down"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection