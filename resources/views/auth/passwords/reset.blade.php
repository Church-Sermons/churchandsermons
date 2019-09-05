@section('title', 'Reset Password')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold mb-3 text-center">{{ __('Reset Password') }}</h2>
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"required autofocus>
                                @error('email')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required>
                                @error('password')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password_confirmation" id="confirm-password" class="form-control" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary form-control" type="submit">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
