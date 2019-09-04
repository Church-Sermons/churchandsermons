@section('title', $organisation->name.__(' Team Members'))

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="explore">
        <div class="explore-inner container my-5">
            <div class="row">
                <div class="col">
                    <h2 class="font-weight-bold mb-4 text-center">{{ $organisation->name.__(" Team Members") }}</h2>
                    @component('components.messages')@endcomponent
                    <div class="row">
                        @forelse ($organisation->profiles as $team)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="card">
                                    @hasRoleAndOwns(['administrator', 'author', 'superadministrator'], $organisation)
                                    <span class="d-block text-right mt-2 mr-2">
                                        <form class="d-inline" action="{{ route('organisations.team.destroy', [$organisation->uuid, $team->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <a href="{{ route('organisations.team.edit', [$organisation->uuid, $team->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    </span>
                                    @endOwns
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <img src="{{ asset('storage/'.$team->profile_image) }}" alt="avatar" class="rounded-circle mr-2 mt-2" width="80" height="80">
                                        <h4 class="text-capitalize font-weight-bold mt-1">
                                            <a href="{{ route('profiles.show', $team->uuid) }}">{{ $team->name.__(" ").$team->surname }}</a>
                                        </h4>
                                        <h6 class="text-capitalize mini-texts">{{ $team->category->name }}</h6>
                                        <span class="mb-2">
                                            @forelse (Helper::starRating($team->average_review) as $rating)
                                                <i class="{{ $rating }}"></i>
                                            @empty
                                                <span></span>
                                            @endforelse
                                        </span>
                                        <p class="mini-texts text-center">
                                            {{ $team->description }}
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
                                <p class="lead">No team members added yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section" style="display: none;">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">{{ $organisation->name }} Team Members</h4>
                    </div>
                    <div class="card-content">
                        <div class="columns">
                            @forelse ($organisation->profiles as $profile)
                            <div class="column is-one-third">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src="{{ asset('/storage/'.$profile->profile_image) }}" alt="team-member-image">
                                        </figure>
                                        <div class="card-content">
                                            <div class="table-container">
                                                <table class="table is-narrow">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Name</strong></td>
                                                            <td>{{ $profile->name." ". $profile->surname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Email</strong></td>
                                                            <td>{{ $profile->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Title</strong></td>
                                                            <td>{{ $profile->category->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Description</strong></td>
                                                            <td>{{ $profile->description }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="column">
                                    <p>This organisation has no team members</p>
                                    <a href="{{ route('team.create', $organisation->id) }}" class="m-t-10 button is-primary">
                                        <i class="fas fa-user-plus"></i> Add Member
                                    </a>
                                </div>

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
