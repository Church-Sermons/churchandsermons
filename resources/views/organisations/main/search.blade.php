@section('title', 'Organisation Search')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <section id="custom-banner" class="banner-organisation">
        <div class="custom-banner-inner overlay-secondary">
            <div class="container py-5 text-light">
                <div class="row">
                    <div class="col-md-6 offset-md-3 py-5">
                        <h1 class="text-center text-uppercase font-weight-bold">
                            organisations
                        </h1>
                    </div>
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
                                <form action="{{ route('organisations.search') }}" method="get">
                                    <div class="form-row">
                                        <div class="col-md-3 col-sm-12 mb-1">
                                            <input type="text" name="location" id="location" class="form-control" placeholder="Location - City, Country">
                                        </div>
                                        <div class="col-md-3 col-sm-12 mb-1">
                                            <select name="category" id="category" class="form-control text-capitalize">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    @if($category->linked_to == 'organisation')
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-1">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <button type="submit" class="btn btn-custom text-uppercase form-control">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="search">
                        <div class="container search-inner py-3">
                            @if (count($organisations))
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>User</th>
                                            <th>Category</th>
                                            <th>Average Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($organisations as $organisation)
                                            <tr>
                                                <td>{{ $organisation->name }}</td>
                                                <td>{{ $organisation->description }}</td>
                                                <td>{{ $organisation->user->name }}</td>
                                                <td>{{ $organisation->category->name }}</td>
                                                <td>{{ $organisation->average_review }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>Nothing to display</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @else
                                <p>No results to display</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End of Search Section -->
</div>
@endsection
