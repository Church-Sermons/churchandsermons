@extends('layouts.app')

@section('content')
<div class="section">
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
