@extends('layouts.app')

@section('content')
    <div class="section">
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
