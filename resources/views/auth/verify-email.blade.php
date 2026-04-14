@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@section('title', 'Verify Email')

@section('auth_header', 'Verify your email address')

@section('auth_body')
    <p class="text-muted">
        Thanks for signing up. Before getting started, verify your email address using the link we sent you.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block">Resend Verification Email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-outline-secondary btn-block">Log Out</button>
    </form>
@stop
