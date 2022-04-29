@extends('layouts.app')

@section('js-links')
    <script src="{{ asset('js/tools.js') }}" defer></script>
@endsection

@section('title')
    Tools
@endsection

@section('content')
    <section class="tools">
        <div class="tools__box">
            <div class="tools__text-wrapper">
                <div class="tools__text-header">
                    Tools 
                </div>
                <div class="tools__text">
                    <p>
                        Here you can check what margin bookmaker make on specific bet
                        or calculate value for odd you want to bet.
                    </p>
                    <p>
                        To use calculator type your odds to fields bellow. Result will be
                        automatically available.
                    </p>
                </div>
            </div>
            <div class="tools__calcs-wrapper">
                <div class="tools__calc">
                    <div class="tools__header">
                        Margin calculator
                    </div>
                    <div class="tools__calc-description">
                        <p>
                            Bookmaker margin is estimated amount of return, which bookmaker except to earn
                            on specific type of event. To find more about bookmaker margin check out
                            <a href="">margin</a>.
                        </p>
                    </div>
                    <div class="tools__calc-header">
                        Three way event
                    </div>
                    <div class="tools__inputs">
                        <div class="tools__inputs-headers">
                            <div class="tools__input-header">Home odd</div>
                            <div class="tools__input-header">Draw odd</div>
                            <div class="tools__input-header">Away odd</div>
                        </div>
                        <div class="tools__inputs-box three-way">
                            <input type="text" placeholder="3.6" name="home_odd"
                            class="tools__input">
                            <input type="text" placeholder="2.2" name="draw_odd"
                            class="tools__input">
                            <input type="text" placeholder="3.82" name="away_odd"
                            class="tools__input">
                        </div>
                    </div>
                    <div class="tools__calc-header">
                        Two way event
                    </div>
                    <div class="tools__inputs">
                        <div class="tools__inputs-headers">
                            <div class="tools__input-header">First odd</div>
                            <div class="tools__input-header">Second odd</div>
                        </div>
                        <div class="tools__inputs-box two-way">
                            <input type="text" placeholder="1.8" name="first_odd"
                            class="tools__input">
                            <input type="text" placeholder="2.05" name="second_odd"
                            class="tools__input">
                        </div>
                    </div>
                </div>
                <div class="tools__calc">
                    <div class="tools__header">
                        Value calculator
                    </div>
                    <div class="tools__calc-description">
                        <p>
                            Value is estimated return, which gambler expect to earn from specific bet.
                            Value is simply your advantage over bookmaker.
                            Find out <a href="">more about valuebets</a>.
                        </p>
                        <p>
                            <span class="bold-500">Checked odd</span> is odd from bookie you want to
                            place bet.
                        </p>
                        <p>
                            <span class="bold-500">Real odd</span> is odd which most accurate reflects
                            real chances for succes of specific event. It can be your prediciton or odd
                            from the best bookie for that event (usually Pinnacle).
                        </p>
                        <p>
                            <span class="bold-500">Payout</span> is a result of subtracting margin from 100%.
                            If you are using own odds payout is 100%.
                        </p>
                    </div>
                    <div class="tools__calc-header">
                        Inputs fields
                    </div>
                    <div class="tools__inputs">
                        <div class="tools__inputs-headers">
                            <div class="tools__input-header">Checked odd</div>
                            <div class="tools__input-header">Real odd</div>
                            <div class="tools__input-header">Payout (%)</div>
                        </div>
                        <div class="tools__inputs-box value">
                            <input type="text" placeholder="2.4" name="checked_odd"
                            class="tools__input">
                            <input type="text" placeholder="2.16" name="real_odd"
                            class="tools__input">
                            <input type="text" placeholder="96" name="payout"
                            class="tools__input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection