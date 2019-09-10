@section('title', Auth::user()->name.__(" Profile"))

@extends('layouts.app')

@section('content')
    @include('_partials.nav.sidenav')
    <div id="main">
        <div class="main-inner container my-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Your Profile</h2>
                            <form action="#" method="post">
                                @csrf
                                @method('PUT')
                                @component('user.main.form')
                                    @slot('name')
                                        {{ old('name', Auth::user()->name )}}
                                    @endslot
                                    @slot('surname')
                                        {{ old('surname', Auth::user()->surname) }}
                                    @endslot
                                    @slot('email')
                                        {{ old('email', Auth::user()->email) }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address', Auth::user()->address) }}
                                    @endslot
                                    @slot('profile')
                                        {{ old('profile_image', Auth::user()->profile_image) }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Edit Profile
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
