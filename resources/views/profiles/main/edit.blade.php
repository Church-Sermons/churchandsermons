@section('title', 'Edit Profile')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Edit Profile</h2>

                            @include('components.messages')
                            <form action="{{ route('profiles.update', $profile->uuid) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="profileForm">
                                @csrf
                                @method('PUT')
                                @component('profiles.main.form', ['oldCategory' => old('category', $profile->category_id)])
                                    @slot('name')
                                        {{ old('name', $profile->name) }}
                                    @endslot
                                    @slot('surname')
                                        {{ old('surname', $profile->surname) }}
                                    @endslot
                                    @slot('email')
                                        {{ old('email', $profile->email) }}
                                    @endslot
                                    @slot('website')
                                        {{ old('website', $profile->website) }}
                                    @endslot
                                    @slot('phone')
                                        {{ old('phone', $profile->phone) }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address', $profile->address) }}
                                    @endslot
                                    @slot('latitude')
                                        {{ old('lat', $profile->lat) }}
                                    @endslot
                                    @slot('longitude')
                                        {{ old('lon', $profile->lon) }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description', $profile->description) }}
                                    @endslot
                                    @slot('profile')
                                        {{ old('profile_image', $profile->profile_image) }}
                                    @endslot
                                    <input type="hidden" name="id" id="id" value="{{ $profile->id }}">
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
</div>

{{-- Category Modal Partial --}}
@include('categories.handler', ['parents' => ['profile'], 'selected' => 'profile'])
@endsection
