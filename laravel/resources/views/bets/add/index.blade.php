@extends('layouts.app')

@section('title')
    Add bet
@endsection

@section('js-links')
    <script src="{{ asset('js/add.js') }}" defer></script>
@endsection

@section('content')
    <section class="form">
        <div class="add-bet">
            <form action="/add" method="post">
                @csrf
                <div class="add-bet__header">
                    Add bet
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('bookie') error-text @enderror">
                        @if ($errors->has('bookie'))
                            {{ $errors->first('bookie') }}
                        @else
                            Bookmaker 
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input name="bookie" class="add-bet__input @error('bookie') error-input @enderror"
                        placeholder="Pinnacle" value="{{ old('bookie') }}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('sport') error-text @enderror">
                        @if ($errors->has('sport'))
                            {{ $errors->first('sport') }}
                        @else
                            Sport 
                        @endif

                    </div>
                    <div class="add-bet__input-box">
                        <input name="sport" class="add-bet__input @error('sport') error-input @enderror"
                        placeholder="Basketball" value="{{ old('sport') }}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Date
                    </div>
                    <div class="add-bet__input-box">
                        <input type="date" name="date" class="add-bet__input"
                        value="{{ old('date') ?? date('Y-m-d')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Time
                    </div>
                    <div class="add-bet__input-box">
                        <input type="time" name="time" class="add-bet__input"
                        value="{{ old('time') ?? date('H:i')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('teams') error-text @enderror">
                        @if ($errors->has('teams'))
                            {{ $errors->first('teams') }}
                        @else
                            Teams
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="text" name="teams" 
                        class="add-bet__input max-width-100 @error('teams') error-input @enderror" 
                        placeholder="Denver Nuggets - Orlando Magic" value="{{ old('teams')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('league') error-text @enderror">
                        @if ($errors->has('league'))
                            {{ $errors->first('league') }}
                        @else
                            League
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="text" name="league" 
                        class="add-bet__input max-width-100 @error('league') error-input @enderror" 
                        placeholder="Denver Nuggets - Orlando Magic" value="{{ old('league')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('bet') error-text @enderror">
                       @if ($errors->has('bet'))
                            {{ $errors->first('bet') }}
                        @else
                            Bet
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="text" name="bet"
                        class="add-bet__input @error('bet') error-input @enderror"
                        placeholder="Over 225.5" value="{{ old('bet')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('odd') error-text @enderror">
                        @if ($errors->has('odd'))
                            {{ $errors->first('odd') }}
                        @else
                            Odd
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="text" name="odd"
                        class="add-bet__input width-50 @error('odd') error-input @enderror"
                        placeholder="2.45" value="{{ old('odd')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('value') error-text @enderror">
                        @if ($errors->has('value'))
                            {{ $errors->first('value') }}
                        @else
                            Value
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="text" name="value"
                        class="add-bet__input width-50 @error('value') error-input @enderror" 
                        placeholder="6.45" value="{{ old('value')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box @error('stake') error-text @enderror">
                        @if ($errors->has('stake'))
                            {{ $errors->first('stake') }}
                        @else
                            Stake
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="text" name="stake"
                        class="add-bet__input width-50 @error('stake') error-input @enderror" 
                        placeholder="100" value="{{ old('stake')}}">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Result
                    </div>
                    <div class="add-bet__input-box">
                        <div class="add-bet__input add-bet__result-box">
                            <span>Pending</span>
                            <input type="hidden" name="result" value="pending">
                            <ul class="add-bet__result-list">
                                <li class="add-bet__result-li">Win</li>
                                <li class="add-bet__result-li">Lost</li>
                                <li class="add-bet__result-li">Pending</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__no-error-box">
                        @if (session('status'))
                            {{ session('status') }}
                        @endif
                    </div>
                    <div class="add-bet__input-box">
                        <input type="submit" name="sumbit"
                        class="add-bet__button" value="Add bet">
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection