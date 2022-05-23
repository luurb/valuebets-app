@extends('layouts.app')

@section('title')
    Email verification
@endsection

@section('content') 
    <section class="email">
        <div class="email-box">
            <h1 class="email__header">
                Congrats, your account is almost ready!
            </h1>
            <div class="email__text-box">
                <h3 class="email__small-header">
                    <i class="fa-solid fa-envelope"></i>
                    Verify your email address
                </h3>
                <div class="email__text">
                    Before proceeding, please check your email for verification link.
                    If you don’t receive the email,
                    <form method="post" action="/email/verification-notification">
                        @csrf
                        <button class="email__info-link" type="submit">
                            click here to request another.
                        </button>
                    </form>
                </div>
                @if (session('message'))
                    <p class="email__info">
                        {{session('message')}}
                    </p>
                @endif
            </div>
        </div>
    </section>
@endsection