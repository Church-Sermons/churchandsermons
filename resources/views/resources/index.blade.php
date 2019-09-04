@section('title', 'Resources')

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
                                @component('components.messages')@endcomponent
                                <div class="tab-content py-2" >
                                    <div class="tab-pane show fade active" id="audio">
                                        @forelse ($organisation->resources as $resource)
                                            @if (count($resource->getMedia('audio')))
                                                <div class="audio-container d-flex flex-column border rounded">
                                                    <div class="container pt-3">
                                                        <div class="row">
                                                            {{-- {{ dd($resource->getMedia('audio')[0]) }} --}}
                                                            <div class="col-md-2 pr-1">
                                                                <img src="https://via.placeholder.com/300" alt="placeholder-image" class="rounded w-100" height="80"/>
                                                            </div>
                                                            <div class="col-md-10 pl-2">
                                                                <h4 class="font-weight-bold text-capitalize">{{ $resource->getMedia('audio')[0]->name }}</h4>
                                                                <h5 class="text-capitalize">{{ $organisation->user->name }}</h5>
                                                                <h6 class="text-uppercase text-muted">{{ $resource->getMedia('audio')[0]->human_readable_size }}</h6>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <audio class="media-player" id="player" controls>
                                                        <source src="{{ $resource->getFirstMediaUrl('audio') }}" type="{{ $resource->getMedia('audio')[0]->mime_type }}" />
                                                        {{-- <source src="/path/to/audio.ogg" type="audio/ogg" /> --}}
                                                    </audio>
                                                </div>
                                            @endif
                                            {{-- <div class="card event-card shadow-sm bg-light mb-3">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-2 pr-2">
                                                            <span class="w-100 h-100 bg-primary text-white rounded p-1 d-flex flex-column align-items-center justify-content-center">
                                                                <h1 class="font-weight-bold">{{ Helper::dateFormatter($event->created_at)[1] }}</h1>
                                                                <h5 class="text-capitalize">{{ Helper::dateFormatter($event->created_at)[0] }}</h5>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-10 pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h3 class="h4 mb-1 font-weight-bold w-100">{{ $event->title }}</h3>
                                                                @hasRoleAndOwns(['administrator', 'author', 'superadministrator'], $organisation)
                                                                <span class="w-25 text-right">
                                                                    <form class="d-inline" action="{{ route('organisations.events.destroy', [$event->uuid_link, $event->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                                    </form>
                                                                    <a href="{{ route('organisations.events.edit', [$event->uuid_link, $event->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                                </span>
                                                                @endOwns
                                                            </div>
                                                            <p class="mini-texts my-2 lead">
                                                                <i class="fas fa-map-marker-alt mr-1 text-primary"></i> {{ $event->address }}
                                                            </p>
                                                            <p class="mini-texts mt-1">
                                                                {{ $event->description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @empty
                                            <p class="lead">There are no audio files</p>
                                        @endforelse
                                    </div>
                                    <div class="tab-pane fade" id="video">
                                        <div class="container">
                                            <div class="video-container" style="width: 100%;height: 480px;" class="border">
                                                <video class="media-player" playsinline controls>
                                                    <source src="{{ $organisation->getFirstMediaUrl('videos') }}" type="{{ $organisation->getMedia('videos')[0]->mime_type }}" />
                                                    {{-- <source src="/path/to/video.webm" type="video/webm" /> --}}

                                                    {{-- <!-- Captions are optional -->
                                                    <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default /> --}}
                                                </video>
                                                @foreach ($organisation->resources as $resource)
                                                    @if (count($resource->getMedia('video')))
                                                        <div class="card mt-3">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    {{-- {{ dd($resource->getMedia('audio')[0]) }} --}}
                                                                    <div class="col-md-2 pr-1">
                                                                        <img src="https://via.placeholder.com/300" alt="placeholder-image" class="rounded w-100" height="80"/>
                                                                    </div>
                                                                    <div class="col-md-10 pl-2">
                                                                        <h4 class="font-weight-bold text-capitalize">{{ $resource->getMedia('video')[0]->name }}</h4>
                                                                        <h5 class="text-capitalize">{{ $organisation->user->name }}</h5>
                                                                        <h6 class="text-uppercase text-muted">{{ $resource->getMedia('video')[0]->human_readable_size }}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endforeach
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

@section('scripts')
    <script>
        const player = Plyr.setup('.media-player');
    </script>
@endsection
