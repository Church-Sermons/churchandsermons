@extends('layouts.app')

@section('content')
<div class="columns m-t-50">
    <div class="column is-one-third is-offset-one-third">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('Reset Password') }}
                </h4>
            </div>
            <div class="card-content">
                @if (session('status'))
                    <div class="notification is-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="field">
                        <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                        <div class="control has-icons-left m-t-5">
                            <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field m-t-5">
                        <div class="control">
                            <button class="button is-primary is-outlined is-fullwidth">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
