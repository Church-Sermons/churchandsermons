"@section('title',"{$resource->name}")

@extends('layouts.app')

@section('content')
@include('_partials.nav.sidenav')
<div id="safeguard">
    <div id="main">
        <div class="container main-inner py-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        @if (strpos($resource->collection_name, 'video') !== false)
                            {{-- <img src="{{ asset('images/app/defaults/video.svg') }}" alt="{{ $resource->name }}" class="w-75 h-75"> --}}
                            <video poster="{{ $resource->getUrl('large') }}" id="video-player" playsinline controls>
                                    <source src="{{ $resource->getFullUrl() }}" type="{{ $resource->mime_type }}" />
                            </video>
                        @elseif(strpos($resource->collection_name, 'document') !== false)
                            <img src="{{ asset('images/app/defaults/file.svg') }}" alt="{{ $resource->name }}" class="w-75 h-75">
                            {{-- <a href="{{ $resource->getFullUrl() }}" class="btn btn-primary mt-2">Download</a> --}}
                        @elseif(strpos($resource->collection_name, 'audio') !== false)
                            <img src="{{ asset('images/app/defaults/musical-note.svg') }}" alt="{{ $resource->name }}" class="w-75 h-75">
                            @include('_partials.media.audio', ['data' => [$resource]])
                        @elseif(strpos(explode("/", $resource->mime_type)[0], 'image') !== false)
                            <img src="{{ $resource->getUrl() }}" alt="{{ $resource->name }}" class="w-100 h-100">
                            {{-- <a href="{{ $resource->getFullUrl() }}" class="btn btn-primary mt-2">Download</a> --}}
                        @else
                            <div class="text-center">
                                <i class="far fa-file fa-10x"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>File Name</th>
                                        <td>{{ $resource->file_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>File Type</th>
                                        <td>{{ $resource->mime_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uploaded</th>
                                        <td>{{ $resource->created_at?$resource->created_at->diffForHumans():null }}</td>
                                    </tr>
                                    <tr>
                                        <th>File Size</th>
                                        <td>{{ $resource->human_readable_size }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

