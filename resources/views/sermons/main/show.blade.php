@section('title', "{$sermon->title}")

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <div id="details">
            <div class="details-inner container my-5">
                @include('components.messages')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title font-weight-bold">{{ $sermon->title }}</h3>
                                <p class="card-text mb-1">
                                    {{ $sermon->description }}
                                </p>
                                <p class="mini-texts text-muted mt-1">
                                    <span><i class="{{ Helper::checkDuration($sermon->created_at) }}"></i> {{ $sermon->created_at?$sermon->created_at->diffForHumans():null }}</span>
                                    <span class="font-weight-bold ml-1 mr-2 h-100 border"></span>
                                    <span class="text-capitalize"><i class="fas fa-user-circle"></i> {{ $sermon->user->name }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h3 class="card-title font-weight-bold">Resources</h3>
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
                                         @if (count($sermon->getMedia('audio')))
                                            {{-- audio details styled component - displays the audio details --}}
                                            @component('components.audio-details')
                                                @slot('albumArt')
                                                {{ asset('images/app/audio-icon.png') }}
                                                @endslot
                                                @slot('title')
                                                {{ $sermon->getMedia('audio')[0]->getCustomProperty('title') }}
                                                @endslot
                                                @slot('artist')
                                                {{ $sermon->getMedia('audio')[0]->getCustomProperty('artist') }}
                                                @endslot
                                                @slot('size')
                                                {{ $sermon->getMedia('audio')[0]->human_readable_size }}
                                                @endslot
                                            @endcomponent

                                            {{-- audio partial - holds the audio element --}}
                                            @include('_partials.media.audio', ['data' => $sermon->getMedia('audio')])

                                            {{-- audio playlist component - displays the audio  --}}
                                            @component('components.audio-playlist', ['data' => $sermon->getMedia('audio')])
                                                @slot('id')
                                                    {{ $sermon->uuid }}
                                                @endslot
                                                @slot('name')
                                                    {{ $name }}
                                                @endslot
                                            @endcomponent
                                        @else
                                            <p class="lead">There are no audio resources available</p>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="video">
                                        <p class="lead">There are no video resources available</p>
                                    </div>
                                    <div class="tab-pane fade" id="document">
                                        <p class="lead">There are no documents available</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <h3 class="card-title font-weight-bold">Recent Reviews</h3>
                                    </div>
                                    <div class="col-2 text-right">
                                        @auth
                                            <a href="{{ route('sermons.reviews.create', $sermon->uuid) }}" class="btn btn-success btn-sm" title="Add Review"><i class="fas fa-plus"></i></a>
                                        @endauth
                                    </div>
                                </div>
                                @auth
                                    @forelse ($sermon->reviews as $review)
                                        @if ($loop->iteration > 5)
                                            @break
                                        @endif
                                        <div class="media">
                                            <img src="{{ asset('images/default-logo.png')}}" alt="reviewer-avatar" height="64" width="64" class="align-self-start mr-2 rounded-circle">
                                            <div class="media-body">
                                                {{-- <span>
                                                    @forelse (Helper::starRating($sermon->rating) as $rating)
                                                        <i class="{{ $rating }}"></i>
                                                    @empty
                                                        <i class="o"></i>
                                                    @endforelse
                                                </span> --}}
                                                <h5 class="font-weight-bold mb-1 text-capitalize">{{ $review->user->name }}</h5>
                                                <p class="my-1">{{ $review->message }}</p>
                                                <h6 class="text-muted mini-texts mt-1"><i class="mr-1 {{ Helper::checkDuration($review->created_at) }}"></i>{{ $review->created_at?$review->created_at->diffForHumans():null }}</h6>
                                                {{-- @isTribrid(['administrator', 'author', 'superadministrator'], $review)
                                                    <form class="d-inline mr-1 mt-1" action="{{ route('organisations.reviews.destroy', [$review->uuid_link, $review->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endisTribrid --}}
                                            </div>
                                        </div>
                                        @unless ($loop->last)
                                            <hr>
                                        @endunless

                                    @empty
                                        <p class="lead">There are no reviews at the moment</p>
                                    @endforelse
                                @else
                                    <p class="lead text-center text-info">
                                        Please <a href="{{ route('login') }}">Log In</a> to submit a review
                                    </p>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title font-weight-bold">Share</h3>
                                <div class="d-flex flex-wrap">
                                    <a href="#" class="mr-1 text-center mb-1 bg-primary text-white py-1" style="width: 48%">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="mr-1 text-center mb-1 bg-primary text-white py-1" style="width: 48%">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="mr-1 text-center mb-1 bg-primary text-white py-1" style="width: 48%">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="mr-1 text-center mb-1 bg-primary text-white py-1" style="width: 48%">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
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
                                            @foreach (Helper::starRating($sermon->average_review) as $rating)
                                                <i class="{{ $rating }}"></i>
                                            @endforeach
                                            <span class="text-muted ml-1">{{ $sermon->average_review?$sermon->average_review:'0.0' }}</span>
                                        </span>

                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-4">
                                        <h6 class="h6">Claims</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted d-block text-right">{{ $organisation->claims()->count() }}</span>
                                    </div>
                                </div> --}}

                                @auth
                                    <span class="d-block border w-100 my-3"></span>
                                    <p class="mini-texts">Something Wrong? <a href="{{ route('sermons.claims.create', $sermon->uuid) }}">Send Claim</a></p>
                                    <p class="mini-texts">Something In Mind? <a href="{{ route('sermons.reviews.create', $sermon->uuid) }}">Write Review</a></p>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
