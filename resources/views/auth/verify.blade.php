@extends('layouts.app')

@section('content')
<div class="columns m-t-50">
    <div class="column is-one-third is-offset-one-third">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('Verify Your Email Address') }}
                </h4>
            </div>
            <div class="card-content">
                    @if (session('resent'))
                        <div class="notification is-success">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
            </div>
        </div>
    </div>
</div>
@endsection
