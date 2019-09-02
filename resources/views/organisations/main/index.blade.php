@section('title', 'Organisations')

@extends('layouts.app')

@section('content')
<div id="safeguard">
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
</div><!-- End of safeguard wrapper -->
@endsection
