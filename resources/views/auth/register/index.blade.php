@extends('layouts.home')

@section('title')
    Register
@endsection

@section('home-content')
    <div class="auth">
        <form action="/register" method="post">
            @csrf
            <div class="auth__header">
                <span class="auth__header-left">Re</span>gistration
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
                <label for="email" class="auth__input-label">Email address</label>
                <input type="text" placeholder="example@example.com" name="email" value="{{ old('email')}}"
                class="auth__input @error('email') error-input @enderror">
                @error('email')
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
                <label for="password_confirmation" class="auth__input-label">Password confirmation</label>
                <input type="password" placeholder="Password confirmation" name="password_confirmation" 
                class="auth__input">
            </div>
            <div class="auth__input-box">
                <input type="submit" name="sumbit" value="Register now" class="auth__button">
            </div>
            <div class="auth__text">
                Already have a account?
                <a href="/login">Log in</a>
            </div>
        </form>
    </div> 
@endsection