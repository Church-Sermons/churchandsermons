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
                            <div class="row mb-3">
                                <div class="col">
                                    <a href="{{ route('organisations.resources.create', $organisation->uuid) }}" class="btn btn-success w-100">
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
                                @component('components.messages')@endcomponent
                                <div class="tab-content py-2" >
                                    <div class="tab-pane show fade active" id="audio">

                                        <div class="audio-container d-flex flex-column border rounded mb-2">
                                            @if (count($organisation->getMedia('audio')))
                                                <audio class="media-player" id="player" controls>
                                                    @foreach ($organisation->getMedia('audio') as $audio)
                                                        @if ($loop->first)
                                                            <source src="{{ $audio->getUrl() }}" type="{{ $audio->mime_type }}" />
                                                        @endif
                                                        <source src="{{ $audio->getUrl() }}" type="{{ $audio->mime_type }}" />
                                                    @endforeach

                                                </audio>
                                                <div class="container pt-3">
                                                    <div class="row">
                                                        <div class="col-md-2 pr-1">
                                                            <img src="https://via.placeholder.com/300" alt="placeholder-image" class="rounded w-100" height="80"/>
                                                        </div>

                                                        <div class="col-md-8 pl-2">
                                                            <h4 class="font-weight-bold text-capitalize">{{ $organisation->getMedia('audio')[0]->file_name }}</h4>
                                                            <h5 class="text-capitalize">{{ $organisation->user->name }}</h5>
                                                            <h6 class="text-uppercase text-muted">{{ $organisation->getMedia('audio')[0]->human_readable_size }}</h6>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <form class="d-inline mr-1" action="{{ route('organisations.resources.destroy', [$organisation->uuid, $organisation->getMedia('audio')[0]->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                            <a href="{{ route('organisations.resources.edit', [$organisation->uuid, $organisation->getMedia('audio')[0]->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="playlist-container w-100">
                                                    <div class="table-responsive">
                                                        <table class="table-hover table mb-0">
                                                            <tbody>
                                                                @foreach ($organisation->getMedia('audio') as $audio)
                                                                    <tr>
                                                                        <td class="active">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="col-2 text-center">
                                                                                    <h4 class="font-weight-bold">{{ $loop->iteration }}</h4>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <h6 class="my-1 text-capitalize font-weight-bold w-100">{{ $audio->file_name }}</h6>
                                                                                    <p class="my-1 text-muted text-capitalized w-100">{{ $organisation->user->name }}</p>
                                                                                </div>
                                                                                <div class="col-2 text-right">
                                                                                    <h4 class="text-muted">{{ gmdate('i:s', Helper::mediaMetadata($audio->getFullUrl())) }}</h4>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                            <p class="lead">There are no audio files</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="video">
                                        <div class="container">
                                            <div class="video-container" style="width: 100%;height: 480px;" class="border">
                                                <video class="media-player" playsinline controls>
                                                    <source src="{{ $organisation->getFirstMediaUrl('video') }}" type="video/mp4" />
                                                    {{-- <source src="/path/to/video.webm" type="video/webm" /> --}}

                                                    {{-- <!-- Captions are optional -->
                                                    <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default /> --}}
                                                </video>
                                                @forelse ($organisation->getMedia('video') as $resource)
                                                    <div class="card mt-3">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                {{-- {{ dd($resource->getMedia('audio')[0]) }} --}}
                                                                <div class="col-md-2 pr-1">
                                                                    <img src="https://via.placeholder.com/300" alt="placeholder-image" class="rounded w-100" height="80"/>
                                                                </div>
                                                                <div class="col-md-10 pl-2">
                                                                    <h4 class="font-weight-bold text-capitalize">{{ $resource->name }}</h4>
                                                                    <h5 class="text-capitalize">{{ $organisation->user->name }}</h5>
                                                                    <h6 class="text-uppercase text-muted">{{ $resource->human_readable_size }}</h6>
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

