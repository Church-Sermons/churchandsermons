@section('title', Auth::user()->name.__(" Profile"))

@extends('layouts.app')

@section('content')
    @include('_partials.nav.sidenav')
    <div id="main">
        <div class="main-inner container my-5">
            @include('components.messages')
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Update Password</h2>
                            <form action="{{ route('user.profile.security.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                @component('user.password.password-form')
                                    @slot('oldPassword')
                                        {{ __("") }}
                                    @endslot
                                    @slot('password')
                                        {{ __("") }}
                                    @endslot
                                    @slot('confirmPassword')
                                        {{ __("") }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Update Password
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

