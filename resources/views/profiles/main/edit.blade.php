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
                                {{-- import from form execs --}}
                                @includeIf('components.form-execs.profile',
                                    ['submitText' => 'Edit Profile', 'profile' => $profile ])
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
