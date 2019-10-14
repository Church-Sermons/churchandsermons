@section('title', 'Edit About Page')

@extends('layouts.app')

@section('content')
@include('_partials.nav.sidenav')
<div id="main">
    <div class="main-inner container my-5">
        @include('components.messages')
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold mb-3 text-center">Edit About Page</h2>
                        <form action="{{ route('user.site.about.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @component('user.site.about-form', ['id' => old('id', $details->id)])
                                @slot('description')
                                    {{ old('description', $details->description) }}
                                @endslot
                                @slot('missionVision')
                                    {{ old('mission', $details->mission) }}
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

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('about-description');
        CKEDITOR.replace('about-mission');
    </script>
@endsection
