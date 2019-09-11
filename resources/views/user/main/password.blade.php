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
                                @component('user.main.password-form')
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

@section('styles')
    <style>
        #sidenav{
            height: 100vh;
            width: 250px;
            position: fixed;
            padding-top: 15px;
            overflow-y: auto;
        }
        .sidenav-inner{
            width: 100%;
            height: 100%;
        }

        .sidenav-inner a:hover{
            background: #ccc;
            color: #000;
        }

        .sidenav-inner a{
            color: grey;
        }
        #main{
            padding-left: 250px;
        }
        .has-background-primary{
            background: #ccc;
        }
    </style>
@endsection
