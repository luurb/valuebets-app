@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('js-links')
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="form">
        <div class="dashboard">
            <div class="dashboard__account-info">
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                class="dashboard__avatar" alt="account avatar"/>
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
                                {{ auth()->user()->email }}
                            </span>
                        </div>
                        <div class="dashboard__account-input-box">
                            <span class="dashboard__input-name">
                                Name:
                            </span>
                            <span class="dashboard__input">
                                {{ auth()->user()->name }}
                            </span>
                            <button class="dashboard__edit-button edit-name-button">
                                Edit
                            </button>
                        </div>
                        <div class="dashboard__account-input-box">
                            <span class="dashboard__input-name">
                                Password:
                            </span>
                            <span class="dashboard__input">******</span>
                            <button class="dashboard__edit-button edit-pass-button">
                                Edit
                            </button>
                        </div>
                        <div class="dashboard__account-input-box">
                            <span class="dashboard__input-name">
                                Profile picture:
                            </span>
                            <form action="/dashboard" method="post" id="img-form" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                            </form>
                            <label class="dashboard__input dashboard__file-input">
                                <i class="fa-solid fa-image"></i>
                                <span>Choose image</span>
                                <input type="file" form="img-form" name="profile-picture">
                            </label>
                            <button type="submit" class="dashboard__edit-button" form="img-form">
                                Edit
                            </button>
                        </div>
                        @error('profile-picture')
                            <span class="error-text">
                                {{ $message }}. Max image size is 2048MB.
                            </span>
                        @enderror
                        <form action="/dashboard" method="post" class="dashboard__delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="dashboard__button delete-account-button">
                                Delete account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dashboard__stats">
                <h1 class="dashboard__header">
                    Bets statistics
                </h1>
                <x-dashboard.dashboard-stats-box sport="all" betsCount="{{ $all['counter'] }}" 
                yield="{{ $all['yield'] }}" value="{{ $all['value'] }}" return="{{ $all['return'] }}"/>
                <x-dashboard.dashboard-stats-box sport="football" betsCount="{{ $football['counter'] }}" 
                yield="{{ $football['yield'] }}" value="{{ $football['value'] }}" return="{{ $football['return'] }}"/>
                <x-dashboard.dashboard-stats-box sport="basketball" betsCount="{{ $basketball['counter'] }}" 
                yield="{{ $basketball['yield'] }}" value="{{ $basketball['value'] }}" return="{{ $basketball['return'] }}"/>
                <x-dashboard.dashboard-stats-box sport="tennis" betsCount="{{ $tennis['counter'] }}" 
                yield="{{ $tennis['yield'] }}" value="{{ $tennis['value'] }}" return="{{ $tennis['return'] }}"/>
                <x-dashboard.dashboard-stats-box sport="esport" betsCount="{{ $esport['counter'] }}" 
                yield="{{ $esport['yield'] }}" value="{{ $esport['value'] }}" return="{{ $esport['return'] }}"/>
            </div>
        </div>
    </section>
@endsection