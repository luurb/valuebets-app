@extends('layouts.main')

@section('title')
    Bet history
@endsection

@section('main-content')
    <table class="main-table__table main-table__history-table">
        <thead>
            <tr>
                <th scope="colgroup">ID</th>
                <th scope="colgroup">Bookmaker</th>
                <th scope="colgroup">Sport</th>
                <th scope="colgroup">Date and time</th>
                <th scope="colgroup">Teams</th>
                <th scope="colgroup">Bet</th>
                <th scope="colgroup">Odd</th>
                <th scope="colgroup">Value</th>
                <th scope="colgroup">Stake</th>
                <th scope="colgroup">Result</th>
                <th scope="colgroup">Return</th>
                <th scope="colgroup">
                    <input type="submit" value="Delete" class="main-table__button">
                </th>
                <th scope="colgroup"></th>
            </tr>
        </thead>
        <tbody>
            <tr class="">
            </tr>
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
        <span class="filters__header">All time stats</span>
        <div class="filters__stats">
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Return</span>
                <span class="filters__value"></span>
            </div>
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Yield</span>
                <span class="filters__value"></span>
            </div>
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Avg value</span>
                <span class="filters__value"></span>
            </div>
        </div>
        <span class="filters__header">Set time stats</span>
        <div class="filters__stats">
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Return</span>
                <span class="filters__value"></span>
            </div>
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Yield</span>
                <span class="filters__value"></span>
            </div>
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Avg value</span>
                <span class="filters__value"></span>
            </div>
            <div class="filters__box">
                <span class="filters__header filters__header--stat">Time range </span>
                <form method="GET" action="bet_history.php">
                    <input type="date" name="first_date" class="filters__input">
                    <span class="ftilers__header filters__header--stat">/</span>
                    <input type="date" name="second_date" class="filters__input">
                    <input type="submit" name="submit" class="filters__button filters__submit">
                </form>
            </div>
        </div>
    </div>
@endsection