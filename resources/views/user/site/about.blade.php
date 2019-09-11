@section('title', 'Edit About Page')

@extends('layouts.app')

@section('content')
@include('_partials.nav.sidenav')
<div id="main">
    <div class="main-inner container my-5">
        @include('components.messages')
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold mb-3 text-center">Edit About Page</h2>
                        <form action="{{ route('user.profile.security.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            @component('user.site.about-form')
                                @slot('description')
                                    {{ old('description') }}
                                @endslot
                                @slot('missionVision')
                                    {{ old('mission') }}
                                @endslot
                                @slot('submitButtonText')
                                    Update Info
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
