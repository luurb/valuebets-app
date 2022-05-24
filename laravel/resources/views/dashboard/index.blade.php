@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="form">
        <div class="dashboard">
            <div class="dashboard__account-info">
                <img src="{{asset('images/avatars/akumpo.png')}}" class="dashboard__avatar" alt="account avatar">
                </img>
                <div class="dashboard__account-info-box">
                    <h1 class="dashboard__header">
                        Account information
                    </h1>
                    <div class="dashboard__account-inputs">
                        <div class="dashboard__account-input-box">
                            <span class="dashboard__input-name">
                                Email:
                            </span>
                            <span class="dashboard__input">
                                luckyluk20@gmail.com
                            </span>
                        </div>
                        <div class="dashboard__account-input-box">
                            <span class="dashboard__input-name">
                                Name:
                            </span>
                            <input type="text" class="dashboard__input" value="luckyluk">
                            <button class="dashboard__button">
                                Edit
                            </button>
                        </div>
                        <div class="dashboard__account-input-box">
                            <span class="dashboard__input-name">
                                Password:
                            </span>
                            <input type="text" class="dashboard__input" value="**********">
                            <button class="dashboard__button">
                                Edit
                            </button>
                        </div>
                        <button class="dashboard__delete-button">
                            Delete account
                        </button>
                    </div>
                </div>
            </div>
            <div class="dashboard__stats">
                <h1 class="dashboard__header">
                    Bets statistics
                </h1>
                <div class="dashboard__stats-box">
                    <div class="dashboard__stats-header">
                        All
                    </div>
                    <div class="dashboard__stats-results-wrapper">
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Bets
                            </div>
                            <div class="dashboard__result">
                                104
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Yield
                            </div>
                            <div class="dashboard__result">
                                5.43%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Avg value
                            </div>
                            <div class="dashboard__result">
                                4.78%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Return
                            </div>
                            <div class="dashboard__result dashboard__result-return">
                                1200$$
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__stats-box">
                    <div class="dashboard__stats-header">
                        <img src="{{asset('images/svg/football.svg')}}" alt="football image icon"
                            class="dashboard__icon" />
                        Football
                    </div>
                    <div class="dashboard__stats-results-wrapper">
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Bets
                            </div>
                            <div class="dashboard__result">
                                104
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Yield
                            </div>
                            <div class="dashboard__result">
                                5.43%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Avg value
                            </div>
                            <div class="dashboard__result">
                                4.78%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Return
                            </div>
                            <div class="dashboard__result dashboard__result-return">
                                1200$$
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__stats-box">
                    <div class="dashboard__stats-header">
                        <img src="{{asset('images/svg/basketball.svg')}}" alt="basketball image icon"
                            class="dashboard__icon" />
                        Basketball
                    </div>
                    <div class="dashboard__stats-results-wrapper">
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Bets
                            </div>
                            <div class="dashboard__result">
                                104
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Yield
                            </div>
                            <div class="dashboard__result">
                                5.43%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Avg value
                            </div>
                            <div class="dashboard__result">
                                4.78%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Return
                            </div>
                            <div class="dashboard__result dashboard__result-return">
                                1200$$
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__stats-box">
                    <div class="dashboard__stats-header">
                        <img src="{{asset('images/svg/tennis.svg')}}" alt="tennis image icon"
                        class="dashboard__icon" />
                        Tennis
                    </div>
                    <div class="dashboard__stats-results-wrapper">
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Bets
                            </div>
                            <div class="dashboard__result">
                                104
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Yield
                            </div>
                            <div class="dashboard__result">
                                5.43%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Avg value
                            </div>
                            <div class="dashboard__result">
                                4.78%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Return
                            </div>
                            <div class="dashboard__result dashboard__result-return">
                                1200$$
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__stats-box">
                    <div class="dashboard__stats-header">
                        <img src="{{asset('images/svg/esport.svg')}}" alt="esport image icon"
                        class="dashboard__icon" />
                        Esport
                    </div>
                    <div class="dashboard__stats-results-wrapper">
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Bets
                            </div>
                            <div class="dashboard__result">
                                104
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Yield
                            </div>
                            <div class="dashboard__result">
                                5.43%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Avg value
                            </div>
                            <div class="dashboard__result">
                                4.78%
                            </div>
                        </div>
                        <div class="dashboard__stats-results-box">
                            <div class="dashboard__stat-name">
                                Return
                            </div>
                            <div class="dashboard__result dashboard__result-return">
                                2123123
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection