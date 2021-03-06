@extends('layouts.main')

@section('description')
    Check your bets history, which contains statistics for value,
    yield, return and number of bets. 
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    Bets history
@endsection

@section('js-links')
    <script src="{{ asset('js/history.js') }}" defer></script>
@endsection

@section('nav-box-content')
    <nav class="pagination">
    {{ $bets->links('bets.history.pagination.index') }}
        <span class="pagination__results-box">
            <span class="pagination__results-counter-text">
                Results:
            </span>
            <span class="pagination__results-counter">
                <span>
                    {{ $counter }}
                </span>
                <i class="fa-solid fa-angle-down"></i>
                <ul class="pagination__counter-list">
                    <li class="pagination__counter-option">10</li>
                    <li class="pagination__counter-option">20</li>
                    <li class="pagination__counter-option">50</li>
                    <li class="pagination__counter-option">100</li>
                </ul>
            </span>
        </span>
    </nav>
@endsection

@section('main-content')
    <form id="delete-form"></form>
    <div class="main-table__nav">
        <div class="main-table__nav-left">
            <span class="main-table__nav-info">
                <i class="fa-solid fa-circle-info"></i>
            </span>
            <div class="main-table__nav-info-list">
                <span>
                    <i class="fa-solid fa-trash">
                    </i>
                    - choose for delete
                </span>
                <span>
                    <i class="fa-solid fa-wrench grey-f">
                    </i>
                    - click for modify 
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
                class="main-table__nav-trash main-table__input" form="delete-form">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>
    </div>
    <div class="main-table__bets">
        @if ($bets->count())
            @foreach ($bets as $bet)
            <div class="main-table__bet-wrapper">
                <div class="main-table__row">
                    <div class="main-table__data relative max-width-30">
                        <span class="result-span result-{{ strtolower($bet->result) }}-span">
                            {{ strtolower($bet->result) }}
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
                                    class="main-table__img" />
                                <div class="main-table__bet-info-data">{{ $bet->date_time }}</div>
                            </div>
                            <div class="main-table__teams-box">
                                <div class="main-table__teams {{ strtolower($bet->result) }}">
                                    {{ $bet->teams }}
                                </div>
                                <div class="main-table__league">
                                    {{ $bet->league }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
@endsection

@section('filters-content')
    <span class="filters__header">All time stats</span> 
    <div class="filters__stats"> 
        <div class="filters__box"> 
            <span class="filters__header filters__header--stat">Return</span> 
            <span class="filters__value">{{ $allTimeStats['return'] }}</span> 
        </div> 
        <div class="filters__box"> 
            <span class="filters__header filters__header--stat">Yield</span> 
            <span class="filters__value">{{ $allTimeStats['yield'] }}%</span> 
        </div> 
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Avg value</span>
            <span class="filters__value">{{ $allTimeStats['value'] }}%</span>
        </div>
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Number of bets</span>
            <span class="filters__value">{{ $allTimeStats['counter'] }}</span>
        </div>
    </div>
    <span class="filters__header">Set time stats</span>
    <div class="filters__stats">
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Return</span>
            <span class="filters__value">{{ $overTimeStats['return'] }}</span>
        </div>
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Yield</span>
            <span class="filters__value">{{ $overTimeStats['yield'] }}</span>
        </div>
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Avg value</span>
            <span class="filters__value">{{ $overTimeStats['value'] }}%</span>
        </div>
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Number of bets</span>
            <span class="filters__value">{{ $overTimeStats['counter'] }}</span>
        </div>
        <div class="filters__box">
            <span class="filters__header filters__header--stat">Time range </span>
                @if ($errors->has('first_date') || $errors->has('second_date'))
                    <div class="filters__error error-text">Please insert correct date</div> 
                @endif
            <form method="post" action="/history/time-range">
                @csrf
                <input type="date" name="first_date" class="filters__date-input"
                @if (session('first_date'))
                    value="{{ session('first_date') }}" 
                @else 
                    value="{{ date('Y-m-d') }}" 
                @endif
                >
                <div class="filters__date-separator">/</div>
                <input type="date" name="second_date" class="filters__date-input"
                @if (session('second_date'))
                    value="{{ session('second_date') }}" 
                @else 
                    value="{{ date('Y-m-d') }}" 
                @endif
                >
                <input type="submit" name="submit" value="Submit"
                class="filters__button filters__submit purple-input">
            </form>
        </div>
    </div>
@endsection