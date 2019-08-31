@extends('layouts.app')
@section('content')

<div class="columns m-t-50">
    <div class="column is-one-third is-offset-one-third">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('Login') }}
                </h4>
            </div>
            <div class="card-content">
                <form action="{{ route('login') }}" method="POST" role="form">
                    @csrf
                    <div class="field">
                        <label for="email" class="label">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input type="email" name="email" id="email" class="input @error('email') is-danger @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                        <label for="password" class="label">Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input type="password" name="password" id="password" class="input @error('password') is-danger @enderror" required autocomplete="new-password">
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
                    <div class="field">
                        <div class="control">
                            <b-checkbox name="remember" class="m-t-5 m-b-5">Remember Me</b-checkbox>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button class="button is-primary is-outlined is-fullwidth">Log In</button>
                        </div>
                    </div>
                </form>
            </div><!-- End of Card Content-->


        </div>
        <h5 class="has-text-centered m-t-15">
            <a href="{{ route('password.request') }}" class="has-text-grey is-muted">Forgot Password</a>
        </h5>
    </div>
</div>
@endsection

@section('scripts')

<script>
    const app = new Vue({
        el:'#app',
        data:{

        }
    });
</script>
@endsection
