@extends('layouts.app')

@section('styles')
<style>
.event-card{
    display: flex;
    border: solid 1px hsl(171, 100%, 41%);

}
.date-section{
    background: hsl(171, 100%, 41%);
    padding: 20px;
    text-align: center;
}

.image-section{
    flex: 1;
    position: relative;
}
.image-section::after{
    height: 100%;
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0;
    content: '';
    background: rgba(0, 0, 0, 0.25);
    z-index: 5;
}

.image-section img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.body{
    flex: 5;
    padding: 8.5px;
    line-height: 1.5;
    justify-content: space-evenly;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
}
</style>

@endsection
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
                                    <img src="{{ asset('/storage/'.$profile->profile_image)}}" alt="profile-image">
                                </figure>
                            </div>
                        </div>
                        <hr>
                        <div class="field has-text-centered is-uppercase m-t-15">
                            <h3 class="title is-6">Contact Information</h3>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Location</h4>
                            <p class="subtitle is-6">{{ $profile->address }}</p>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Phone</h4>
                            <p class="subtitle is-6">{{ $profile->phone }}</p>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Email</h4>
                            <p class="subtitle is-6">{{ $profile->email }}</p>
                        </div>
                        <div class="field has-text-left">
                            <h4 class="title is-6">Website</h4>
                            <p class="subtitle is-6"><a href="{{ $profile->website }}">{{ $profile->website}}</a></p>
                        </div>
                        <hr>
                        <div class="field">
                            <h4 class="title is-6 m-b-30">Rating</h4>
                            <p class="subtitle is-6 average_rating" data-ratings="{{ $profile->average_review }}">
                                <span class="stars-outer">
                                    <span class="stars-inner"></span>
                                </span>
                            </p>
                        </div>
                        <hr>
                        <form action="{{ route('profiles.contacts.store', $profile->id) }}" method="POST">
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
                                    <input type="hidden" name="org_id" value="{{ $profile->id }}">
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
                        <form action="{{ route('profiles.claims.store', $profile->id) }}" method="POST">
                            @csrf
                            <div class="field">
                                <label for="claim_subject" class="label">Subject</label>
                                <div class="control">
                                    <input type="hidden" name="org_id" value="{{ $profile->id }}">
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
                                        <h4 class="title is-4">{{ $profile->name }} {{ $profile->surname }}</h4>
                                        <h4 class="subtitle is-5 is-uppercase">{{ $profile->category->name }}</h4>
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
                                        <img src="https://source.unsplash.com/random/1280x720" alt="slide-image">
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
                                        {{ $profile->description }}
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">Resources</h4>
                                    <div class="is-pulled-right">
                                        <a href="{{ route('profiles.resources.create', $profile->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="Add Member">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a href="{{ route('profiles.resources.index', $profile->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="View All">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-content">
                                    @if ($profile->resources->count() > 0)

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
                                                    @foreach ($profile->resources as $resource)
                                                        <tr>
                                                            <td>{{ $resource->name }}</td>
                                                            <td>{{ $resource->description }}</td>
                                                            <td><button class="button is-success is-outlined player" data-file="{{ $resource->file_name }}"><i class="{{ $resource->category->name == 'audio'?'far fa-play-circle':'fas fa-video' }}"></i></button></td>
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

                            <hr>

                            <div class="columns">
                                    <div class="column">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-header-title">Events</h3>
                                                <div class="is-pulled-right">
                                                    <a href="{{ route('profiles.events.create', $profile->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="Add Member">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <a href="{{ route('profiles.events.index', $profile->uuid) }}" class="button is-primary is-outlined m-t-5 m-r-5" title="View All">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                @forelse($profile->events as $event)
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
        const ratingsDOM = JSON.parse(document.querySelector('#ratings')? document.querySelector('#ratings').getAttribute('data-ratings'):null);
        const ids = JSON.parse(document.querySelector('#reviewIds').getAttribute('data-ids'));

        // assign arrays to object
        let ratings = Object.assign(...ids.map((v, i) => ({[`comment${v}`]:ratingsDOM[i]})));

        ratings = {
            ...ratings,
            average_rating:document.querySelector('.average_rating').getAttribute('data-ratings')

        }

        console.log(ratings);

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

            document.querySelector('.ratings').addEventListener('mouseleave', leaveStarListener);
        }

        function enterStarListener(e){
            fillStarsUpToElement(e.target);
        }

        function leaveStarListener(){
            fillStarsUpToElement(null);
        }

        function onClickListener(e){
            // map to hidden
            const ratingStore = document.querySelector('.rating-store');
            ratingStore.value = e.target.getAttribute('data-value');

            // display rating on the right
            document.querySelector('.rating-display').innerHTML = ratingStore.value;
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
