@extends('layouts.home')

@section('title')
    Add bet
@endsection

@section('home-content')
    <main class="home">
        <div class="add-bet">
            <form action="http://localhost:8005/add" method="post">
                @csrf
                <div class="add-bet__header">
                    Add bet
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Bookmaker
                    </div>
                    <div class="add-bet__input-box">
                        <select name="bookie" class="add-bet__select">
                            <option>22bet</option>
                            <option>Pinnacle</option>
                        </select>
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Sport
                    </div>
                    <div class="add-bet__input-box">
                        <select name="sport" class="add-bet__select">
                        </select>
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Date
                    </div>
                    <div class="add-bet__input-box">
                        <input type="date" name="date" class="add-bet__input">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Time
                    </div>
                    <div class="add-bet__input-box">
                        <input type="time" name="time" class="add-bet__input">
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
                        class="add-bet__input @error('teams') error-input @enderror" 
                        placeholder="Denver Nuggets - Orlando Magic">
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
                        placeholder="Over 225.5">
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
                        placeholder="2.45">
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
                        placeholder="6.45">
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
                        placeholder="100">
                    </div>
                </div>
                <div class="add-bet__box">
                    <div class="add-bet__label-box">
                        Result
                    </div>
                    <div class="add-bet__input-box">
                        <select name="result" class="add-bet__select">
                        </select>
                    </div>
                </div>
                <div class="add-bet__box">
                    <div></div>
                    <div class="add-bet__input-box">
                        <input type="submit" name="sumbit"
                        class="add-bet__button" value="Add bet">
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection