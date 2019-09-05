@section('title', $organisation->name)

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <section id="banner">
        <div class="banner-content">
            <div class="dark-overlay py-5">
                <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                    <!-- Logo Image-->
                    <img src="{{ Helper::setFallbackLogoImage($organisation->getFirstMediaUrl('logo', 'main')) }}" alt="{{ $organisation->name.__("-Logo") }}" width="200" height="200" class="rounded">
                    <h4 class="text-center display-4 text-uppercase font-weight-bold my-2">
                        {{ ucwords($organisation->name) }}
                    </h4>

                </div>
            </div>
        </div>
    </section><!-- End of Banner Section -->

    <section id="details">
        <div class="details-inner container my-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-image-handler-lg">
                            <img src="{{ asset('images/temp/slides/slide-1.jpg') }}" alt="slide-image-holder" class="rounded-top w-100 h-100">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title font-weight-bold">About</h3>
                            <p class="card-text">
                                {{ $organisation->description }}
                            </p>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            {{-- <span class="d-block my-3 border border-bottom w-100"></span> --}}
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title font-weight-bold mb-3">Events</h3>
                                </div>
                                <div class="col text-right">
                                    @hasRoleAndOwns(['administrator', 'author', 'superadministrator'], $organisation)
                                        <a href="{{ route('organisations.events.create', $organisation->uuid) }}" class="btn btn-primary mr-1 btn-sm" title="Create"><i class="fas fa-plus"></i></a>
                                    @endOwns
                                    <a href="{{ route('organisations.events.index', $organisation->uuid) }}" class="btn btn-success btn-sm" title="View All"><i class="fas fa-list-ul"></i></a>
                                </div>
                            </div>
                            @forelse ($organisation->events as $event)
                                <div class="card border-right bg-light mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 pr-2">
                                                <span class="w-100 h-100 bg-primary text-white rounded p-1 d-flex flex-column align-items-center justify-content-center">
                                                    <h1 class="font-weight-bold">{{ Helper::dateFormatter($event->created_at)[1] }}</h1>
                                                    <h5 class="text-capitalize">{{ Helper::dateFormatter($event->created_at)[0] }}</h5>
                                                </span>
                                            </div>
                                            <div class="col-md-10 pl-2">
                                                <h3 class="h4 mb-1 font-weight-bold">{{ $event->title }}</h3>
                                                <p class="mini-texts my-2 lead">
                                                    <i class="fas fa-map-marker-alt mr-1 text-primary"></i> {{ $event->address }}
                                                </p>
                                                <p class="mini-texts mt-1">
                                                    {{ $event->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="lead">There are no events coming up</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title font-weight-bold mb-3">Resources</h3>
                                </div>
                                <div class="col text-right">
                                    @hasRoleAndOwns(['administrator', 'author', 'superadministrator'], $organisation)
                                        <a href="{{ route('organisations.resources.create', $organisation->uuid) }}" class="btn btn-primary mr-1 btn-sm" title="Create"><i class="fas fa-plus"></i></a>
                                    @endOwns
                                    <a href="{{ route('organisations.resources.index', $organisation->uuid) }}" class="btn btn-success btn-sm" title="View All"><i class="fas fa-list-ul"></i></a>
                                </div>
                            </div>

                            <ul class="nav nav-pills nav-justified bg-light">
                                <li class="nav-item">
                                    <a
                                    href="#audio"
                                    class="nav-link active"
                                    data-toggle="pill"
                                    >
                                    <i class="fas fa-music"></i> Audio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                    href="#video"
                                    class="nav-link"
                                    data-toggle="pill"
                                    >
                                    <i class="fas fa-film"></i> Video
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                    href="#document"
                                    class="nav-link"
                                    data-toggle="pill"
                                    >
                                    <i class="far fa-file-alt"></i> Document
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-4">
                                <div class="tab-pane active" id="audio">
                                    @forelse ($organisation->getMedia('audio') as $audio)
                                        <div class="row">
                                            <div class="col">
                                                <div class="audio-container d-flex flex-column border rounded">
                                                    <div class="container pt-3">
                                                        <div class="row">
                                                            <div class="col-md-2 pr-1">
                                                                <img src="https://via.placeholder.com/300" alt="placeholder-image" class="rounded w-100" height="80"/>
                                                            </div>
                                                            <div class="col-md-10 pl-2">
                                                                <h4 class="font-weight-bold text-capitalize">{{ $audio->name }}</h4>
                                                                <h5 class="text-capitalize">{{ $organisation->user->name }}</h5>
                                                                <h6 class="text-uppercase text-muted">{{ $audio->human_readable_size }}</h6>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <audio id="audio-player" class="media-player" controls>
                                                        <source src="{{ $audio->getUrl() }}" type="{{ $audio->mime_type }}" />
                                                        {{-- <source src="/path/to/audio.ogg" type="audio/ogg" /> --}}
                                                    </audio>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="col">
                                            <p class="lead">No audio resources available</p>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="tab-pane fade" id="video">
                                    <div class="row">
                                        @forelse ($organisation->getMedia('video') as $video)
                                            <div class="col-lg-4 col-sm-6 col-xs-12">
                                                <div class="card">
                                                    <img src="{{ asset('images/temp/slides/slide-2.jpg') }}" alt="video-placeholder" height="150" class="w-100 rounded">
                                                    <div class="dark-overlay d-flex justify-content-center align-items-center">
                                                        <a href="#" class="btn btn-success btn-lg" data-video-access="{'url': {{ $video->getFullUrl() }},'name': {{ $video->name }},'mime': {{ $video->mime_type }}}">
                                                            <i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col">
                                                <p class="lead">No video resources available</p>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="document">
                                    <div class="col-lg-3 col-sm-6 col-xs-12">
                                        <div class="card border-0">
                                        <img
                                            src="https://via.placeholder.com/100"
                                            alt="audio-placeholder"
                                        />
                                        <a href="#" class="h4 mini-texts mt-2 mb-1"
                                            >Lorem, ipsum dolor.</a
                                        >
                                        <h4 class="h4 text-muted mini-texts">
                                            2.4 MB
                                        </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title font-weight-bold mb-3">Team</h3>
                                </div>
                                <div class="col text-right">
                                    @hasRoleAndOwns(['administrator', 'author', 'superadministrator'], $organisation)
                                        <a href="{{ route('organisations.team.create', $organisation->uuid) }}" class="btn btn-primary mr-1 btn-sm" title="Create"><i class="fas fa-user-plus"></i></a>
                                    @endOwns
                                    <a href="{{ route('organisations.team.index', $organisation->uuid) }}" class="btn btn-success btn-sm" title="View All"><i class="fas fa-list-ul"></i></a>
                                </div>
                            </div>

                            <div class="row">
                                @forelse ($organisation->profiles as $profile)
                                    <div class="col-md-6 col-sm-12 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <img src="{{ asset('storage/'.$profile->profile_image) }}" alt="avatar" class="rounded-circle mr-2 mt-2" width="100" height="100" style="object-fit: cover;">
                                                <h4 class="text-capitalize font-weight-bold mt-1">
                                                    <a href="{{ route('profiles.show', $profile->uuid) }}">{{ $profile->name.__(" ").$profile->surname }}</a>
                                                </h4>
                                                <h6 class="text-capitalize mini-texts">{{ $profile->category->name }}</h6>
                                                <span class="mb-2">
                                                    @forelse (Helper::starRating($profile->average_review) as $rating)
                                                        <i class="{{ $rating }}"></i>
                                                    @empty
                                                        <span></span>
                                                    @endforelse
                                                </span>
                                                <p class="mini-texts text-center">
                                                    {{ $profile->description }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <div class="col">
                                        <p class="lead">No team members added yet</p>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-uppercase h5 font-weight-bold">contact information</h4>
                            <h6 class="h6 font-weight-bold">Location</h6>
                            <p class="lead mini-texts">{{ $organisation->address }}</p>
                            <h6 class="h6 font-weight-bold">Phone</h6>
                            <p class="lead mini-texts">{{ $organisation->phone }}</p>
                            <h6 class="h6 font-weight-bold">Email</h6>
                            <p class="lead mini-texts">{{ $organisation->email }}</p>
                            <h6 class="h6 font-weight-bold">Website</h6>
                            <p class="lead mini-texts">{{ $organisation->website }}</p>
                        </div>
                    </div>

                    <div class="card my-2">
                        <div class="card-body">
                            <h4 class="card-title text-uppercase h5 font-weight-bold">status</h4>
                            <div class="row">
                                <div class="col-4">
                                    <h6 class="h6">Reviews</h6>
                                </div>
                                <div class="col-8">
                                    <span class="d-block text-right">
                                        @forelse (Helper::starRating($organisation->average_review) as $rating)
                                            <i class="{{ $rating }}"></i>
                                        @empty
                                            <p class="small text-muted"></p>
                                        @endforelse
                                        <span class="text-muted ml-1">{{ $organisation->average_review?$organisation->average_review:'0.0' }} ({{ $organisation->reviews->count() }})</span>
                                    </span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h6 class="h6">Messages</h6>
                                </div>
                                <div class="col-8">
                                    <span class="text-muted d-block text-right">{{ $organisation->contacts->count() }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h6 class="h6">Claims</h6>
                                </div>
                                <div class="col-8">
                                    <span class="text-muted d-block text-right">{{ $organisation->claims()->count() }}</span>
                                </div>
                            </div>

                            <span class="d-block border w-100 my-3"></span>

                            <p class="mini-texts">Need Any Help? <a href="{{ route('organisations.contacts.create', $organisation->uuid) }}">Contact Us</a></p>
                            @auth
                                <p class="mini-texts">Something Wrong? <a href="{{ route('organisations.claims.create', $organisation->uuid) }}">Send Claim</a></p>
                                <p class="mini-texts">Something In Mind? <a href="{{ route('organisations.reviews.create', $organisation->uuid) }}">Write Review</a></p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- End of safeguard wrapper -->

@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('scripts')
    <script>
        const player = new Plyr("#player");
    </script>
@endsection
