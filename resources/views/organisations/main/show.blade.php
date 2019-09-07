@section('title', $organisation->name)

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <section id="banner">
        <div class="banner-content">
            <div class="dark-overlay py-5">
                <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                    <!-- Logo Image-->
                    <img src="{{ Helper::displayImage($organisation->logo)->fromOwnTable() }}" alt="{{ $organisation->name.__("-Logo") }}" width="200" height="200" class="rounded">
                    <h4 class="text-center display-4 text-uppercase font-weight-bold my-2">
                        {{ ucwords($organisation->name) }}
                    </h4>

                </div>
            </div>
        </div>
    </section><!-- End of Banner Section -->

    <section id="details">
        <div class="details-inner container my-5">
            @component('components.messages')@endcomponent
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if (count($organisation->getMedia('slides')))
                                @include('components.carousel', ['slides' => $organisation->getMedia('slides')])
                            @else
                            <div class="card-image-handler-lg">
                                <img src="{{ asset('images/temp/slides/slide-1.jpg') }}" alt="slide-image-holder" class="rounded-top w-100 h-100">
                            </div>
                            @endif
                            <h3 class="card-title font-weight-bold mt-3">About</h3>
                            <p class="card-text">
                                {{ $organisation->description }}
                            </p>
                        </div>
                    </div>
                    <style>
                        #appCarousel .carousel-item{
                            width: 100%;
                            height: 350px;
                            position: relative;
                        }
                        #appCarousel .carousel-item::after{
                            background: rgba(0, 0, 0, 0.25);
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            left: 0;
                            bottom: 0;
                            content: '';
                            z-index: 2;
                        }

                        .carousel-control{
                            z-index: 5;
                        }

                    </style>
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
                                    @if (count($organisation->getMedia('audio')))

                                        {{-- audio details styled component - displays the audio details --}}
                                        @component('components.audio-details')
                                            @slot('albumArt')
                                            {{ __("https://source.unsplash.com/300x300/?music") }}
                                            @endslot
                                            @slot('title')
                                            {{ Helper::media($organisation->getMedia('audio')[0]->getFullUrl())->getTitle() }}
                                            @endslot
                                            @slot('artist')
                                            {{ Helper::media($organisation->getMedia('audio')[0]->getFullUrl())->getArtist() }}
                                            @endslot
                                            @slot('size')
                                            {{ $organisation->getMedia('audio')[0]->human_readable_size }}
                                            @endslot
                                        @endcomponent

                                        {{-- audio partial - holds the audio element --}}
                                        @include('_partials.media.audio', ['data' => $organisation->getMedia('audio')])

                                        {{-- audio playlist component - displays the audio  --}}
                                        @component('components.audio-playlist', ['data' => $organisation->getMedia('audio')])
                                            @slot('id')
                                                {{ $organisation->uuid }}
                                            @endslot
                                        @endcomponent
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <p class="lead">No audio resources found</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="video">
                                    <div class="row">
                                        @forelse ($organisation->getMedia('video') as $video)
                                            @if ($loop->iteration <= 6)
                                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                                    <div class="card mb-2">
                                                        <img src="{{ $video->getUrl('small') }}" alt="video-placeholder" height="150" class="w-100 rounded">
                                                        <div class="dark-overlay d-flex flex-column justify-content-between align-items-end" title="{{ $video->getCustomProperty('description')}}">
                                                            <div class="mx-1 mt-1">
                                                                <form class="d-inline" action="{{ route('organisations.resources.destroy', [$organisation->uuid, $video->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-outline-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                                <a title="Edit" href="{{ route('organisations.resources.edit', [$organisation->uuid, $video->id])}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            </div>
                                                            <a href="#" class="video mr-1 mb-1 btn btn-outline-success" title="Play" data-toggle="modal"
                                                                data-target="#categoryModal"
                                                                data-poster="{!! $video->getUrl('small') !!}" data-src="{!! $video->getFullUrl() !!}"
                                                                data-title="{!! $video->name !!}" data-type="{!! $video->mime_type !!}"
                                                                data-size="{!! $video->human_readable_size !!}" data-description="{!! $video->getCustomProperty('description') !!}"
                                                                data-published="{!! $video->created_at?$video->created_at->diffForHumans():null !!}">
                                                                <i class="fas fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="card">
                                                        <h6 class="text-capitalize py-2 px-2">
                                                            <a href="#" data-toggle="modal" data-target="#categoryModal">{{ str_replace("-", " ",pathinfo($video->file_name, PATHINFO_FILENAME)) }}</a>
                                                        </h6>
                                                    </div> --}}
                                                </div>
                                            @endif
                                        @empty
                                            <div class="row">
                                                <div class="col">
                                                    <p class="lead">No video resources found</p>
                                                </div>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="document">
                                    @if (count($organisation->getMedia('document')))
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr class="d-flex">
                                                        <th class="col-3">Name</th>
                                                        <th class="col-6">Description</th>
                                                        <th class="col-2">Size</th>
                                                        <th class="col-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($organisation->getMedia('document') as $document)
                                                        @if ($loop->iteration <= 6)
                                                            <tr class="d-flex">
                                                                <td class="col-3">
                                                                    <a href="{{ $document->getFullUrl() }}">{{ $document->name }}</a>
                                                                </td>
                                                                <td class="col-6 mini-texts">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum aliquam facere eius, perspiciatis dolorum fuga?</td>
                                                                <td class="col-2">{{ $document->human_readable_size }}</td>
                                                                <td class="col-1">
                                                                    <div class="mx-1 mt-1 text-right">
                                                                        <form class="d-inline" action="{{ route('organisations.resources.destroy', [$organisation->uuid, $document->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-outline-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                                        </form>
                                                                        <a title="Edit" href="{{ route('organisations.resources.edit', [$organisation->uuid, $document->id])}}" class="btn mt-1 btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <p class="lead">No documents found</p>
                                            </div>
                                        </div>
                                    @endif
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
                            <p class="lead mini-texts">
                                <a href="{{ $organisation->website }}" target="_blank">{{ $organisation->website }}</a>
                            </p>
                            {{-- {{ dd(date('g:i a', strtotime('1:00'))) }} --}}
                            <h6 class="h6 font-weight-bold mb-0">Working Hours</h6>
                            @if (count($organisation->schedules))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm my-0">
                                        <tbody>
                                            @foreach ($organisation->schedules as $schedule)
                                                <tr>
                                                    <td>{{ Config::get('site_variables.days')[$schedule->day_of_week] }}</td>
                                                    <td>{{ date('g:i a', strtotime("{$schedule->time_open}:00")) }}</td>

                                                    <td>{{ date('g:i a', strtotime(Helper::sumTime($schedule->time_open, $schedule->work_duration)->isFullyFormatted())) }}</td>
                                                </tr>
                                                <p class="lead mini-texts">


                                                    {{-- {{ date('g:i a', strtotime(".($schedule->time_open + $schedule->work_duration).")) }} --}}
                                                </p>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="lead mini-texts">No work schedule added yet</p>
                            @endif
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

{{-- Video Modal Component --}}
{{-- @include('_partials.media.video') --}}
@component('_partials.media.video')
    <div class="media mt-4">
        <img src="#" alt="#" height="64" id="video-poster" width="64" class="rounded-circle mr-2 align-self-start">
        <div class="media-body">
            <h4 class="text-capitalize mb-0 font-weight-bold" id="video-title"></h4>
            <p class="my-1 lead" id="video-description"></p>
            <h4 class="mini-texts text-muted">
                <span class="text-uppercase mr-1" id="video-size"></span>{{ __("|") }}
                <span id="video-published" class="ml-1 text-capitalized"></span>
            </h4>
        </div>
    </div>
@endcomponent

@endsection


