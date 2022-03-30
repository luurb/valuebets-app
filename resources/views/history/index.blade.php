@extends('layouts.main')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    Bet history
@endsection

@section('js-links')
    <script src="{{ asset('js/history.js') }}" defer></script>
@endsection

@section('nav-box__left')
    <div class="nav-box__info-box">
        <div class="nav-box__bets-counter">
            Found {{ $betsCount }} bets
        </div>
    </div>
@endsection

@section('nav-box-content')
    {{ $bets->links() }}
@endsection

@section('main-content')
    <table class="main-table__table main-table__history-table">
        <form id="delete-form">
        </form>
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
                    <input type="button" value="Delete" 
                    class="main-table__button main-table__delete-button"
                    form="delete-form">
                </th>
                <th scope="colgroup"></th>
            </tr>
        </thead>
        <tbody>
            @if ($bets->count())
                @php
                    $iter = 0;
                @endphp
                @foreach ($bets as $bet)
                    @php
                       $iter++; 
                    @endphp
                    <tr>
                        <td><span class="main-table__iter-span">{{ $iter }}</span></td> 
                        <td>{{ $bet->bookie->bookie_name }}</td> 
                        <td>{{ $bet->sport->sport_name }}</td> 
                        <td>{{ $bet->date_time }}</td> 
                        <td class="{{ strtolower($bet->result) }}">
                            {{ $bet->teams }}
                        </td> 
                        <td>{{ $bet->bet }}</td> 
                        <td>{{ $bet->odd }}</td> 
                        <td>{{ $bet->value . ' %'}}</td> 
                        <td class="stake">{{ $bet->stake . ' $'}}</td> 
                        <td>{{ $bet->result }}</td> 
                        <td class="{{ strtolower($bet->result) }}">{{ $bet->return . ' $' }}</td> 
                        <td>
                            <label>
                                <input type="checkbox" value="{{ $bet->id }}" name="delete[]" 
                                class="main-table__checkbox--del none" form="delete-form">
                                <span class="main-table__span main-table__history-span">Del</span>
                            </label>
                        </td>
                        </form>
                        <td>
                            <form method="get" action="/modify">
                                <input type="hidden" name="id" value="{{ $bet->id }}">
                                <button type="submit" value="" 
                                class="main-table__button main-table__history-button">Mod</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>         
    </table>
@endsection

@section('filters-content')
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
                    <input type="submit" name="submit" 
                    class="filters__button filters__submit purple-input">
                </form>
            </div>
        </div>
    </div>
@endsection