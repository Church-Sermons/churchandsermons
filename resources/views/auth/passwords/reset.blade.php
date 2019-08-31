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
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="field">
                        <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                        <div class="control has-icons-left">
                            <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password" class="label">{{ __('Password') }}</label>
                        <div class="control has-icons-left">
                            <input id="password" type="password" class="input @error('password') is-danger @enderror" name="password" required autocomplete="new-password">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        @error('password')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>
                        <div class="control has-icons-left">
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button type="submit" class="is-primary is-outlined is-fullwidth button">{{ __('Reset Password') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
