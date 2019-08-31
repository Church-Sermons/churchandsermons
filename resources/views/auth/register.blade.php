@extends('layouts.app')

@section('content')

<div class="columns">
    <div class="column is-one-third is-offset-one-third m-t-50">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('Register') }}
                </h4>
            </div>
            <div class="card-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="field">
                        <label for="name" class="label">{{ __('Name') }}</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="name" type="text" class="input @error('name') is-danger @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                            @error('name')
                            <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                        <div class="control has-icons-left has-icons-right">
                            <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                            @error('email')
                            <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror

                        </div>
                        @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="columns">
                            <div class="column">
                                <label for="password" class="label">{{ __('Password') }}</label>

                                <div class="control has-icons-left has-icons-right">
                                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    @error('password')
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    @enderror

                                </div>
                                @error('password')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="column">
                                <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>

                                <div class="control has-icons-left">
                                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="field">
                        <div class="control">
                            <button class="button is-primary is-outlined is-fullwidth">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div><!-- End of Card Content-->
        </div>
        <h5 class="has-text-centered m-t-15">
            <a href="{{ route('login') }}" class="has-text-grey is-muted">Already A Member?</a>
        </h5>
    </div>
</div>
@endsection
