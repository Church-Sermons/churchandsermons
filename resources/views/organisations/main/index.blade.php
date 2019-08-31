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
                            <h4 class="title is-4">Organisations</h4>
                            </div>
                            <div class="column is-two-fifths">
                                @auth
                                    <a href="{{ route('organisations.create') }}" class="button is-primary is-pulled-right">
                                        <i class="fas fa-plus m-r-5"></i> Create Organisation
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">

                                @if ($organisations->count() > 0)
                                <div class="table-container">
                                    <table class="table is-striped is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Website</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($organisations as $organisation)
                                                <tr>
                                                    <td>{{ ucwords($organisation->name) }}</td>
                                                    <td>{{ $organisation->website }}</td>
                                                    <td>{{ $organisation->description }}</td>
                                                    <td>{{ ucwords($organisation->category->name) }}</td>
                                                    <td class="has-text-right">
                                                        <a href="{{ route('organisations.show', $organisation->uuid) }}" class="button is-outlined m-b-5">View</a>
                                                        @if (Auth::check() && Auth::user()->id == $organisation->user_id)
                                                            <a href="{{ route('organisations.edit', $organisation->uuid) }}" class="button is-outlined">Edit</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <p class="is-danger is-5">There are no organisations to display at the moment</p>
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
