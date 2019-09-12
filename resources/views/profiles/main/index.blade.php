@section('title', 'Profiles')

@extends('layouts.app')

@section('content')
<div id="safeguard">

    <section id="banner">
        <div class="banner-content banner-profile">
            <div class="dark-overlay py-5">
                <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                    <h4 class="text-center display-4 text-uppercase font-weight-bold">
                        {{ __("profiles") }}
                    </h4>
                    @auth
                        <a href="{{ route('profiles.create') }}" class="btn btn-primary btn-lg text-uppercase">
                            <i class="fas fa-plus"></i> create profile
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <section id="search">
        <div class="container search-content my-5">
            <div class="row">
                <div class="col">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="container">
                                <form action="#" method="post">
                                    <div class="form-row">
                                        <div class="col-md-3 col-sm-12">
                                            <input type="text" name="location" id="location" class="form-control" placeholder="Location - City, Country">
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <select name="category" id="category" class="form-control">
                                                <option selected disabled>Select Category</option>
                                                <option value="1">Speaker</option>
                                                <option value="2">Musician</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword">
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <button type="button" class="btn btn-primary text-uppercase form-control">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End of Search Section -->

    <div id="explore">
        <div class="explore-inner container my-5">
            @include('components.messages')
            <div class="row">
                <div class="col">
                    <div class="row">
                        @forelse ($profiles as $profile)
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-2">
                                <div class="card h-100">
                                    @isTribrid($profile)
                                    <span class="d-block text-right mt-2 mr-2">
                                        <form class="d-inline" action="{{ route('profiles.destroy', $profile->uuid) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <a href="{{ route('profiles.edit', $profile->uuid) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    </span>
                                    @endisTribrid
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <img style="object-fit: cover;" src="{{ asset('storage/'.$profile->profile_image) }}" alt="avatar" class="rounded-circle mr-2 mt-2" height="100" width="100">
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

                                        <span class="d-block border border-bottom my-3"></span>
                                        <span class="text-center d-flex justify-content-between w-50">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="col">
                                <p class="lead">No profiles added yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="section d-none">
        <div class="container">
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column is-three-fifths">
                                <h4 class="title is-4">Profiles</h4>
                            </div>
                            <div class="column is-two-fifths">
                                @auth
                                    <a href="{{ route('profiles.create') }}" class="button is-primary is-pulled-right">
                                        <i class="fas fa-plus m-r-5"></i> Create Profile
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">

                                @if ($profiles->count() > 0)
                                <div class="table-container">
                                    <table class="table is-striped is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Surname</th>
                                                <th>Website</th>
                                                <th>Category</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($profiles as $profile)
                                                <tr>
                                                    <td>{{ ucwords($profile->name) }}</td>
                                                    <td>{{ $profile->surname }}</td>
                                                    <td><a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a></td>
                                                    <td>{{ ucwords($profile->category->name) }}</td>
                                                    <td class="has-text-right">
                                                        <a href="{{ route('profiles.show', $profile->uuid) }}" class="button is-outlined m-b-5">View</a>
                                                        @if (Auth::check() && Auth::user()->id == $profile->user_id)
                                                            <a href="{{ route('profiles.edit', $profile->uuid) }}" class="button is-outlined">Edit</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <p class="is-danger is-5">There are no profiles to display at the moment</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
