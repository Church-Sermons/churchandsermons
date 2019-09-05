@section('title', 'Email Verification')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="col-md-8 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold mb-3 text-center">{{ __('Verify Your Email Address') }}</h2>
                        @if (session('resent'))
                            <div class="alert alert-success">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <p class="card-text text-left">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
