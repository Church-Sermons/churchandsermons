@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-one-quarter">
                        <div class="level">
                            <div class="level-item has-text-centered">
                                <figure class="image is-128x128 has-text-centered">
                                    <img src="{{ asset('/storage/'.$organisation->logo)}}" alt="organisation-logo">
                                </figure>
                            </div>
                        </div>
                        <hr>
                        <div class="field has-text-centered is-uppercase m-t-15">
                            <h3 class="title is-6">Contact Information</h3>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Location</h4>
                            <p class="subtitle is-6">{{ $organisation->address }}</p>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Phone</h4>
                            <p class="subtitle is-6">{{ $organisation->phone }}</p>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Email</h4>
                            <p class="subtitle is-6">{{ $organisation->email }}</p>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Website</h4>
                            <p class="subtitle is-6"><a href="{{ $organisation->website }}">{{ $organisation->website}}</a></p>
                        </div>
                        <hr>
                        <div class="field">
                            <h4 class="title is-6 m-b-30">Rating</h4>
                            <p class="subtitle is-6 average_rating" data-ratings="{{ $organisation->average_review }}">
                                <span class="stars-outer">
                                    <span class="stars-inner"></span>
                                </span>
                            </p>
                        </div>
                        <hr>
                        <form action="{{ route('organisations.contacts.store', $organisation->uuid) }}" method="POST">
                            @csrf
                            <div class="field">
                                <label for="name" class="label">Name</label>
                                <div class="control">
                                    <input type="text" class="input @error('name') is-danger @enderror" value="{{ Auth::check()?Auth::user()->name:old('name') }}" @auth readonly @endauth name="name">
                                </div>
                                @error('name')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="email" class="label">Email</label>
                                <div class="control">
                                    <input type="hidden" name="uuid_link" value="{{ $organisation->uuid }}">
                                    <input type="text" class="input @error('email') is-danger @enderror" value="{{ Auth::check()?Auth::user()->email:old('email') }}" @auth readonly @endauth name="email">
                                </div>
                                @error('email')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="subject" class="label">Subject</label>
                                <div class="control">
                                    <input type="text" class="input @error('subject') is-danger @enderror" value="{{ old('subject') }}" name="subject">
                                </div>
                                @error('subject')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="message" class="label">Message</label>
                                <div class="control">
                                    <textarea name="message" rows="5" style="resize: none;" class="textarea @error('message') is-danger @enderror">{{ old('message') }}</textarea>
                                </div>
                                @error('message')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button class="button is-fullwidth is-outlined is-primary m-t-5">Send</button>
                                </div>
                            </div>
                        </form>
                        @auth
                        <hr>
                        <form action="{{ route('organisations.claims.store', $organisation->uuid) }}" method="POST">
                            @csrf
                            <div class="field">
                                <label for="claim_subject" class="label">Subject</label>
                                <div class="control">
                                    <input type="hidden" name="uuid_link" value="{{ $organisation->uuid }}">
                                    <input type="text" class="input @error('claim_subject') is-danger @enderror" value="{{ old('subject') }}" name="claim_subject">
                                </div>
                                @error('claim_subject')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="claim_message" class="label">Message</label>
                                <div class="control">
                                    <textarea name="claim_message" style="resize: none;" rows="5" class="textarea @error('claim_message') is-danger @enderror">{{ old('claim_message') }}</textarea>
                                </div>
                                @error('claim_message')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button class="button is-fullwidth is-outlined is-primary m-t-5">Send</button>
                                </div>
                            </div>
                        </form>
                        @endauth
                    </div>
                    <div class="column is-three-quarters">
                        <div class="container">
                            <div class="columns">
                                <div class="column is-three-quarters">
                                    <div class="field has-text-left">
                                        <h4 class="title is-4">{{ $organisation->name }}</h4>
                                        <h4 class="subtitle is-5 is-uppercase">{{ $organisation->category->name }}</h4>
                                    </div>
                                </div>
                                @auth
                                <div class="column is-one-quarter">
                                    <a href="#reviewForm" class="button is-primary is-fullwidth">
                                        <i class="fas fa-pen-alt m-r-5"></i> Add A Review
                                    </a>
                                </div>
                                @endauth

                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="image-container">
                                        <img src="{{ asset('images/churchandsermons.jpg') }}" alt="slide-image">
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-header-title">
                                        About
                                    </h3>
                                </div>
                                <div class="card-content">
                                    <p class="subtitle is-6">
                                        {{ $organisation->description }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">Resources</h4>
                                    <div class="is-pulled-right">
                                        <a href="{{ route('organisations.resources.create', $organisation->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="Add Member">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a href="{{ route('organisations.resources.index', $organisation->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="View All">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="tabs is-left">
                                        <ul>
                                            <li class="is-active">
                                                <a href="#">
                                                    <span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span>
                                                    <span>Audio</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="icon is-small"><i class="fas fa-film"></i></span>
                                                    <span>Video</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="icon is-small"><i class="fas fa-file-alt"></i></span>
                                                    <span>Documents</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @if ($organisation->resources->count() > 0)

                                        <div class="table-container">
                                            <table class="table is-fullwidth">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($organisation->resources as $resource)
                                                        <tr>
                                                            <td>{{ $resource->name }}</td>
                                                            <td>{{ $resource->description }}</td>
                                                            <td><a data-lightbox="resource" class="button is-success is-outlined player" href="{{ $resource->file_name }}" data-title="{{ $resource->name }}"><i class="{{ $resource->category->name == 'audio'?'far fa-play-circle':'fas fa-video' }}"></i></a></td>
                                                            {{-- <td>
                                                                @if ($resource->category->name == 'audio')
                                                                    <audio id="player" controls>
                                                                        <source src="{{ asset('storage/'.$resource->file_name) }}" type="audio/mp3" />
                                                                    </audio>
                                                                @endif
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p>There are no resources</p>
                                    @endif
                                </div>
                            </div>

                            @auth
                            <hr>
                            <div class="columns">
                                <div class="column">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-header-title">Events</h3>
                                            <div class="is-pulled-right">
                                                <a href="{{ route('organisations.events.create', $organisation->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="Add Member">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <a href="{{ route('organisations.events.index', $organisation->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="View All">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            @forelse($organisation->events as $event)
                                                <div class="card m-b-5">
                                                    <div class="card-content">
                                                        <h3><strong>{{ $event->title }}</strong></h3>
                                                        <h6>{{ $event->address }}</h6>
                                                        <p>{{ $event->description }}</p>
                                                        <small><i class="fas fa-calendar-alt m-r-5"></i>{{ $event->created_at->toFormattedDateString() }}</small>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>There are no upcoming events</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="columns">
                                <div class="column">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-header-title">Team</h4>
                                            <div class="is-pulled-right">
                                                <a href="{{ route('organisations.team.create', $organisation->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="Add Member">
                                                    <i class="fas fa-user-plus"></i>
                                                </a>
                                                <a href="{{ route('organisations.team.index', $organisation->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="View All">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            @if ($organisation->profiles->count() > 0)
                                            <div class="columns">
                                                @foreach ($organisation->profiles as $profile)
                                                <div class="column is-one-fifth">
                                                    <a href="{{ route('profiles.show', $profile->uuid) }}">
                                                        <figure class="is-fullwidth image">
                                                            <img src="{{ asset('storage/'.$profile->profile_image) }}" alt="team-member-profile-image">
                                                        </figure>
                                                        <div class="has-text-centered m-t-10">
                                                            <h5 class="title is-5">{{ $profile->name }} {{ $profile->surname }}</h5>
                                                            <h6 class="subtitle is-6 is-uppercase">{{ $profile->category->name }}</h6>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                                <p>There is no team member added</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="columns">
                                <div class="column is-three-quarters">

                                    <form action="{{ route('organisations.reviews.store', $organisation->uuid) }}" method="POST" id="#reviewForm">
                                        @csrf
                                        <h4 class="subtitle has-text-black-ter is-4">Write Review</h4>
                                        <div class="field">
                                            <div class="control">
                                                <input type="hidden" name="rating" class="rating-store" value="{{ Faker\Factory::create()->randomFloat(1, 1, 4) }}">

                                                <div class="has-text-grey">
                                                    Rating: <span class="rating-display">{{ Faker\Factory::create()->randomFloat(1, 1, 4) }}</span>/5
                                                </div>
                                            </div>
                                            @error('rating')
                                                <p class="help is-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field">
                                            <div class="control">
                                                <input type="hidden" name="uuid_link" value="{{ $organisation->uuid }}">
                                                <textarea name="review_message" placeholder="Write Review" style="resize:none;" rows="5" class="textarea @error('review_message') is-danger @enderror">{{ old('review_message') }}</textarea>
                                            </div>
                                            @error('review_message')
                                                <p class="help is-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field">
                                            <div class="control">
                                                <button class="button is-fullwidth is-outlined is-primary m-t-5">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    @if ($organisation->reviews->count() > 0)
                                    <input type="hidden" name="ids" id="reviewIds" data-ids="{{ $organisation->reviews->pluck('id') }}">
                                    <input type="hidden" name="ratings" id="ratings" data-ratings="{{ $organisation->reviews->pluck('rating') }}">

                                    @foreach ($organisation->reviews as $review)
                                    <div class="media">
                                        <div class="media-content">
                                            <div class="content">
                                                <div class="columns">
                                                    <div class="column is-two-thirds">
                                                        <div class="{{ __("comment").$review->id }} m-b-10">
                                                            <span class="stars-outer">
                                                                <span class="stars-inner"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @if(Auth::check() && $review->user_id == Auth::user()->id)
                                                    <div class="column is-one-third">
                                                        <div class="field">
                                                            <span class="has-text-grey is-pulled-right">
                                                                <button onclick="alert('Still Under Construction');" class="button is-primary is-small is-outlined m-r-5">
                                                                    <i class="fas fa-edit is-4"></i>
                                                                </button>
                                                                <form action="{{ route('organisations.reviews.destroy', [$review->uuid_link, $review->id]) }}" method="POST" class="is-inline-block">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="button is-danger is-small is-outlined">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </button>
                                                                </form>

                                                            </span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <p>
                                                    <strong class="m-r-5">{{ $review->user->name }}</strong><small>{{ __("@").strtolower($review->user->name) }}</small>
                                                    <span class="is-pulled-right has-text-grey-light">
                                                        <small class="icon is-small"><i class="{{ Helper::checkDuration($review->created_at) }}"></i></small>
                                                        <small class="is-small">{{ $review->created_at->diffForHumans() }}</small>
                                                    </span>

                                                </p>
                                                <p>
                                                   {{ $review->message }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                    @else
                                    <div class="field">
                                        <p>
                                            There are no reviews at the moment
                                        </p>
                                    </div>
                                    @endif
                                    <hr>
                                </div>
                                {{-- <div class="column is-one-quarter has-text-centered">
                                    <div class="field">
                                        <h4 class="subtitle is-1">4.5</h4>
                                    </div>
                                    <div class="field">
                                        <i class="far fa-star fa-10x has-text-primary"></i>
                                    </div>
                                </div> --}}
                            </div>
                            @endauth

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
    document.addEventListener('DOMContentLoaded', () => {
        // extract plucked data from data in html
        const ratingsDOM = JSON.parse(document.querySelector('#ratings').getAttribute('data-ratings'));
        const ids = JSON.parse(document.querySelector('#reviewIds').getAttribute('data-ids'));

        // assign arrays to object
        let ratings = Object.assign(...ids.map((v, i) => ({[`comment${v}`]:ratingsDOM[i]})));

        ratings = {
            ...ratings,
            average_rating:document.querySelector('.average_rating').getAttribute('data-ratings')
        }

        const starTotal = 5;

        for(let rating in ratings){
            const starPercentage = (ratings[rating] / starTotal) * 100;

            const startPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;

            document.querySelector(`.${rating} .stars-inner`).style.width = startPercentageRounded;
        }

        const stars = Array.from(document.querySelectorAll('.rating-star'));

        // hover get value
        function starRating(){

            stars.forEach(function(star, index){
                star.setAttribute('data-count', index);
                star.addEventListener('mouseenter', enterStarListener);
                star.addEventListener('click', onClickListener);
            });

            // document.querySelector('.ratings').addEventListener('mouseleave', leaveStarListener);
        }

        function enterStarListener(e){
            fillStarsUpToElement(e.target);
        }

        function leaveStarListener(){
            fillStarsUpToElement(null);
        }

        function fillStarsUpToElement(el){
            stars.forEach(function(star, index){
                if(el == null || star.getAttribute('data-count') > el.getAttribute('data-count')){
                    star.classList.remove('hover');
                }else{
                    star.classList.add('hover');
                }
            });
        }

        // run function
        starRating();
    });
    </script>
@endsection
