@section('title', 'Log In')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold mb-3 text-center">{{ __("Log In") }}</h2>
                        <p class="card-text text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Voluptatem non, quasi aliquid corporis atque, asperiores
                            fuga impedit corrupti autem optio fugit modi accusamus ducimus
                            ut facere. Minus, expedita ut. Odit?
                        </p>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus>
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
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                <label class="custom-control-label" for="remember">Remember Me</label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary form-control" type="submit">Log In</button>
                            </div>
                        </form>
                        <h6 class="text-muted mt-3 text-center"><a href="{{ route('password.request') }}">Forgot Password?</a></h6>
                    </div>
                </div>
                <h6 class="text-muted mt-4 text-center">Not A Member? <a href="{{ route('register') }}"> Sign Up</a></h6>
            </div>
        </div>
    </div>
</div>

@endsection

