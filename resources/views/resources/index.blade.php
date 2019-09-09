@section('title', "{$model->name} {$model->surname} Resources")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="explore">
        <div class="explore-inner container my-5">
            <div class="row">
                <div class="col">
                    <h2 class="font-weight-bold mb-3 text-center">Resources</h2>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="row mb-3">
                                <div class="col">
                                    <a href="{{ route("{$name}.resources.create", $model->uuid) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-plus mr-1"></i> Add Media
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-pills bg-light nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active text-uppercase mini-texts" data-toggle="pill" href="#audio">
                                        <i class="fas fa-music mr-1"></i> Audio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase mini-texts" data-toggle="pill" href="#video">
                                        <i class="fas fa-film mr-1"></i> Video
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase mini-texts" data-toggle="pill" href="#document">
                                        <i class="fas fa-file-alt mr-1"></i>Document
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-8 offset-md-2">
                            <div class="container">
                                @include('components.messages')
                                <div class="tab-content py-2" >
                                    <div class="tab-pane show fade active" id="audio">

                                        <div class="audio-container d-flex flex-column border rounded mb-2">
                                            @if (count($model->getMedia('audio')))
                                                {{-- audio partial - holds the audio element --}}
                                                @include('_partials.media.audio', ['data' => $model->getMedia('audio')])

                                                {{-- audio details styled component - displays the audio details --}}
                                                @component('components.audio-details')
                                                    @slot('albumArt')
                                                        {{ __("https://source.unsplash.com/300x300/?music") }}
                                                    @endslot
                                                    @slot('title')
                                                        {{ $model->getMedia('audio')[0]->name }}
                                                    @endslot
                                                    @slot('artist')
                                                        {{ $model->getMedia('audio')[0]->getCustomProperty('name') }}
                                                    @endslot
                                                    @slot('size')
                                                        {{ $model->getMedia('audio')[0]->human_readable_size }}
                                                    @endslot
                                                @endcomponent
                                                {{-- audio playlist component - displays the audio  --}}
                                                @component('components.audio-playlist', ['data' => $model->getMedia('audio')])
                                                    @slot('id')
                                                        {{ $model->uuid }}
                                                    @endslot
                                                    @slot('name')
                                                        {{ $name }}
                                                    @endslot
                                                @endcomponent
                                            @else
                                                <p class="lead">There are no audio files</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="video">
                                        <div class="container">
                                            <div style="width: 100%;height: 480px;" class="border video-container">
                                                <video class="media-player" id="video-player" playsinline controls>
                                                    <source src="{{ $model->getFirstMediaUrl('video') }}" type="video/mp4" />
                                                    {{-- <source src="/path/to/video.webm" type="video/webm" /> --}}

                                                    {{-- <!-- Captions are optional -->
                                                    <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default /> --}}
                                                </video>
                                                @forelse ($model->getMedia('video') as $resource)
                                                    <div class="card mt-3">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                {{-- {{ dd($resource->getMedia('audio')[0]) }} --}}
                                                                <div class="col-md-2 pr-1">
                                                                    <img src="https://via.placeholder.com/300" alt="placeholder-image" class="rounded w-100" height="80"/>
                                                                </div>
                                                                <div class="col-md-10 pl-2">
                                                                    <h4 class="font-weight-bold text-capitalize">{{ $resource->name }}</h4>
                                                                    <h5 class="text-capitalize">{{ $model->user->name }}</h5>
                                                                    <h6 class="text-uppercase text-muted">{{ $resource->human_readable_size }}</h6>
                                                                    <form class="d-inline mr-1" action='{{ route("{$name}.resources.destroy", [$model->uuid, $resource->id])}}' method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i></button>
                                                                    </form>
                                                                    <a href='{{ route("{$name}.resources.edit", [$model->uuid, $resource->id])}}' class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="lead">There are no video files</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="document">
                                        <p class="lead">There are no documents</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

