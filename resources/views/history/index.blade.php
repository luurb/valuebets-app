@extends('layouts.main')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    History
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
    {{ $bets->links('vendor/pagination.simple-tailwind') }}
@endsection

@section('main-content')
        <form id="delete-form"></form>
        <div class="main-table__nav">
            <div class="main-table__nav-left"></div>
            <div class="main-table__nav-right">
                <span>Delete: </span>
                <button type="button" value="delete"
                    class="main-table__nav-trash main-table__input form=" delete-form">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
        @if ($bets->count())
            @foreach ($bets as $bet)
            <div class="main-table__bet-wrapper">
                <div class="main-table__row">
                    <div class="main-table__data relative max-width-30">
                        <span class="result-span result-{{ strtolower($bet->result) }}-span">
                            @if ($bet->result === 'Pending')
                                ...
                            @else
                                {{ strtolower($bet->result) }}
                            @endif
                        </span>
                        <span class="result-{{ strtolower($bet->result) }}-helper"></span>
                        <span class="main-table__data-span">
                            {{ $bet->bookie->bookie_name }}
                        </span>
                    </div>
                    <div class="main-table__data relative">
                        <span class="main-table__title">
                            bet:
                        </span>
                        <span class="main-table__data-span">
                            {{ $bet->bet }}
                        </span>
                    </div>
                    <div class="main-table__inputs relative">
                        <label>
                            <input type="checkbox" value="{{ $bet->id }}" name="delete[]"
                                class="main-table__checkbox--del none" form="delete-form">
                            <i class="fa-solid fa-trash main-table__trash main-table__input"></i>
                        </label>
                        </input>
                        <form method="get" action="/modify">
                            <input type="hidden" name="id" value="{{ $bet->id }}">
                            <button type="submit" value=""
                                class="main-table__input main-table__wrench">
                                <i class="fa-solid fa-wrench"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="main-table__down-rows">
                    <div class="main-table__row">
                        <div class="main-table__data relative">
                            <span class="main-table__title">
                                value:
                            </span>
                            <span class="main-table__data-span">
                                {{ $bet->value . ' %'}}
                            </span>
                        </div>
                        <div class="main-table__data relative">
                            <span class="main-table__title">
                                odd:
                            </span>
                            <span class="main-table__data-span">
                                {{ $bet->odd }}
                            </span>
                        </div>
                        <div class="main-table__data relative">
                            <span class="main-table__title">
                                stake:
                            </span>
                            <span class="main-table__data-span stake">
                                {{ $bet->stake . ' $'}}
                            </span>
                        </div>
                        <div class="main-table__data relative">
                            <span class="main-table__title">
                                return:
                            </span>
                            <span class="main-table__data-span
                            {{ strtolower($bet->result) }}">
                                {{ $bet->return . ' $' }}
                            </span>
                        </div>
                    </div>
                    <div class="main-table__row">
                        <div class="main-table__data">
                            <div class="main-table__bet-info">
                                <img src="./images/svg/{{ strtolower($bet->sport->sport_name) }}.svg"
                                    class="main-table__img none" />
                                <div class="main-table__bet-info-data">{{ $bet->date_time }}</div>

                            </div>
                            <div class="main-table__teams {{ strtolower($bet->result) }}">
                                {{ $bet->teams }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
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
                <form method="GET" action="bet_main.php">
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