@section('title', Auth::user()->name.__(" Profile"))

@extends('layouts.app')

@section('content')
    @include('_partials.nav.sidenav')
    <div id="main">
        <div class="main-inner container my-5">
            @include('components.messages')
            <div class="row">
                <div class="col-md-5 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Your Profile</h2>
                            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @component('user.main.profile-form')
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
                                        Update Profile
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow">
                        <img src="{{ asset('storage/'.Auth::user()->profile_image)}}" alt="avatar" class="w-100 h-100 img-thumbnail">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

