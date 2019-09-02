@section('title', 'Organisations')

@extends('layouts.app')

@section('content')
    <section id="banner">
        <div class="banner-content">
            <div class="dark-overlay py-5">
                <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                    <h4 class="text-center display-4 text-uppercase font-weight-bold">
                        organisations
                    </h4>
                    @auth
                        <a href="{{ route('organisations.create') }}" class="btn btn-primary btn-lg text-uppercase">
                            <i class="fas fa-plus"></i> create organisation
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
                                                <option value="1">Church</option>
                                                <option value="2">NGO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword">
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <button type="submit" class="btn btn-primary text-uppercase form-control">Search</button>
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

    <section id="explore">

        <div class="container explore-inner my-5">
            <div class="row">
                @forelse ($organisations as $organisation)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card bg-light">
                            <div class="card-image-handler">
                                <img src="{{ Helper::setFallbackLogoImage($organisation->getFirstMediaUrl('logo', 'main')) }}" alt="{{ $organisation->name.__("-Logo") }}" class="w-100 h-100">
                                <div class="card-image-overlay rounded-top d-flex align-items-start justify-content-end p-3">
                                    @hasRoleAndOwns(['administrator', 'author'], $organisation)
                                        <a href="#" class="btn btn-outline-danger mr-1" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                        <a href="{{ route('organisations.edit', $organisation->uuid) }}" class="btn btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    @endOwns
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('organisations.show', $organisation->uuid) }}">
                                        {{ $organisation->name }}
                                    </a>
                                </h4>
                                <h6 class="h6 text-uppercase text-muted">{{ $organisation->category->name }}</h6>
                                <p class="lead small">
                                    {{ $organisation->description }}
                                </p>
                                <span class="d-block w-100 border"></span>
                                <span class="my-2 d-block align-items-center">
                                    @forelse (Helper::starRating($organisation->average_review) as $rating)
                                        <i class="{{ $rating }}"></i>
                                    @empty
                                        <span class="small text-muted"></span>
                                    @endforelse
                                    <span class="text-muted ml-1">{{ $organisation->average_review?$organisation->average_review:'0.0' }} ({{ $organisation->reviews->count() }})</span>
                                </span>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="lead my-3">No registered organisations found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    {{-- <div class="section">
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
    </div> --}}
@endsection
