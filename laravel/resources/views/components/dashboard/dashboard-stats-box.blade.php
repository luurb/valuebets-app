@props(['sport', 'betsCount', 'yield', 'value', 'return'])

<div class="dashboard__stats-box">
    <div class="dashboard__stats-header">
        @if ($sport != 'all')
            <img src="{{asset("images/svg/$sport.svg")}}" alt="{{$sport}} image icon"
            class="dashboard__icon" />
        @endif
        {{ $sport }}
    </div>
    <div class="dashboard__stats-results-wrapper">
        <div class="dashboard__stats-results-box">
            <div class="dashboard__stat-name">
                Bets
            </div>
            <div class="dashboard__result">
                {{ $betsCount }}
            </div>
        </div>
        <div class="dashboard__stats-results-box">
            <div class="dashboard__stat-name">
                Yield
            </div>
            <div class="dashboard__result">
                {{ $yield }}%
            </div>
        </div>
        <div class="dashboard__stats-results-box">
            <div class="dashboard__stat-name">
                Avg value
            </div>
            <div class="dashboard__result">
                {{ $value }}%
            </div>
        </div>
        <div class="dashboard__stats-results-box">
            <div class="dashboard__stat-name">
                Return
            </div>
            <div class="dashboard__result dashboard__result-return 
            @if ($return > 0)
                green-bold
            @else
                red-bold
            @endif
            ">
                {{ $return }}$
            </div>
        </div>
    </div>
</div>