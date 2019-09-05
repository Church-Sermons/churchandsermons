@section('title', 'Sign Up')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold mb-3 text-center">{{ __("Sign Up") }}</h2>
                        <p class="card-text text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Voluptatem non, quasi aliquid corporis atque, asperiores
                            fuga impedit corrupti autem optio fugit modi accusamus ducimus
                            ut facere. Minus, expedita ut. Odit?
                        </p>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"required>
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
                                <button class="btn btn-primary form-control" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
                <h6 class="text-muted mt-4 text-center">Already A Member? <a href="{{ route('login') }}"> Log In</a></h6>
            </div>
        </div>
    </div>
</div>

@endsection
