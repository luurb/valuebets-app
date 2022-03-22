@extends('layouts.main')

@section('title')
    Add bet
@endsection

@section('main-content')
    <form action="{{}}" method="post">
        <table class="main-table__table main-table__add-table">
            <thead>
                <tr>
                    <th scope="colgroup">Bookmaker</th>
                    <th scope="colgroup">Sport</th>
                    <th scope="colgroup">Date</th>
                    <th scope="colgroup">Time</th>
                    <th scope="colgroup">Teams</th>
                    <th scope="colgroup">Bet</th>
                    <th scope="colgroup">Odd</th>
                    <th scope="colgroup">Value [%]</th>
                    <th scope="colgroup">Stake</th>
                    <th scope="colgroup">Result</th>
                    <th scope="colgroup"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="bookie" class="main-table__select">
                        </select>
                    </td>
                    <td>
                        <select name="sport" class="main-table__select">
                        </select>
                    </td>
                    <td><input type="date" name="date" class="main-table__input"></td>
                    <td><input type="time" name="time" class="main-table__input"></td>
                    <td><input type="text" name="teams" value="" class="main-table__input"></td>
                    <td><input type="text" name="bet" value="" class="main-table__input"></td>
                    <td><input type="text" name="odd" value="" class="main-table__input"></td>
                    <td><input type="text" name="value" value="" class="main-table__input"></td>
                    <td><input type="text" name="stake" value="" class="main-table__input"></td>
                    <td>
                    <select name="result" class="main-table__select">
                        <option value="-">-</option>
                        <option value="1">1</option>
                        <option value="0">0</option>
                    </select>   
                </td> 
                    <td><input type="submit" value="Add" name="submit" class="main-table__button"></td>
                </tr>
            </tbody>
        </table>
    </form>
@endsection