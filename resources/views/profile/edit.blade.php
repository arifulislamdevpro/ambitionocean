@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile Settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card title="Profile Information" theme="primary" icon="fas fa-user">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning">
                            <p class="mb-2">Your email address is unverified.</p>
                            <button form="send-verification" class="btn btn-sm btn-outline-warning" type="submit">Resend verification email</button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mb-0 mt-2">A new verification link has been sent.</p>
                            @endif
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Save Changes</button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success ml-2">Saved.</span>
                    @endif
                </form>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Update Password" theme="info" icon="fas fa-lock">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif" autocomplete="current-password">
                        @if($errors->updatePassword->has('current_password'))
                            <span class="invalid-feedback d-block">{{ $errors->updatePassword->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input id="password" name="password" type="password" class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif" autocomplete="new-password">
                        @if($errors->updatePassword->has('password'))
                            <span class="invalid-feedback d-block">{{ $errors->updatePassword->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif" autocomplete="new-password">
                        @if($errors->updatePassword->has('password_confirmation'))
                            <span class="invalid-feedback d-block">{{ $errors->updatePassword->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-info">Update Password</button>

                    @if (session('status') === 'password-updated')
                        <span class="text-success ml-2">Saved.</span>
                    @endif
                </form>
            </x-adminlte-card>

            <x-adminlte-card title="Delete Account" theme="danger" icon="fas fa-trash">
                <p class="text-muted">Deleting your account permanently removes your access to this panel.</p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <label for="delete_password">Confirm Password</label>
                        <input id="delete_password" name="password" type="password" class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif" placeholder="Enter your password to confirm">
                        @if($errors->userDeletion->has('password'))
                            <span class="invalid-feedback d-block">{{ $errors->userDeletion->first('password') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
