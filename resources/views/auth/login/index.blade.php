@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <section class="form">
        <div class="auth">
            <form action="/login" method="post">
                @csrf
                @if (session('status'))
                    <div class="auth__input-box">
                        <div class="auth__error-box">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
                <div class="auth__header">
                    <span class="auth__header-left">Log</span>in
                </div>
                <div class="auth__input-box">
                    <label for="name" class="auth__input-label">User name</label>
                    <input type="text" placeholder="Enter name" name="name" value="{{ old('name')}}" 
                    class="auth__input @error('name') error-input @enderror">
                    @error('name')
                    <div class="auth__error-box">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="auth__input-box">
                    <label for="password" class="auth__input-label">Password</label>
                    <input type="password" placeholder="Password" name="password"
                    class="auth__input @error('password') error-input @enderror">
                    @error('password')
                    <div class="auth__error-box">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="auth__input-box">
                    <input type="submit" name="sumbit" value="Log in" class="auth__button">
                </div>
                <div class="auth__text">
                    Don't have an account?
                    <a href="/register">Sing in</a>
                </div>
            </form>
        </div> 
    </section>
@endsection