@section('title', 'Sermons')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <section id="banner">
            <div class="banner-content banner-sermon">
                <div class="dark-overlay py-5">
                    <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                        <h4 class="text-center display-4 text-uppercase font-weight-bold">
                            sermons
                        </h4>
                        @auth
                            <a href="{{ route('sermons.create') }}" class="btn btn-custom btn-lg text-uppercase">
                                <i class="fas fa-plus"></i> add sermon
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
                                                <input type="text" name="speaker" id="speaker" class="form-control" placeholder="Speaker">
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <select name="category" id="category" class="form-control">
                                                    <option selected disabled>Select Format</option>
                                                    <option value="1">Audio</option>
                                                    <option value="2">Video</option>
                                                    <option value="2">Document</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword">
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <button type="button" class="btn btn-custom text-uppercase form-control">Search</button>
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
                @include('components.messages')
                <div class="row">
                    @forelse ($sermons as $sermon)
                        <div class="col mb-2">
                            <div class="media border p-3 bg-light w-100 h-100">
                                <img src='{{ asset("storage/{$sermon->profiles->first()->profile_image}") }}' class="align-self-start mr-2 rounded-circle" alt="sermon-speaker" width="64" height="64"/>
                                <div class="media-body">
                                    <h5 class="font-weight-bold text-capitalize mb-1">
                                        <a href="{{ route('sermons.show', $sermon->uuid) }}">{{ $sermon->title }}</a>
                                    </h5>
                                    <span class="mb-2">
                                        @forelse (Helper::starRating($sermon->average_review) as $rating)
                                            <i class="{{ $rating }}"></i>
                                        @empty
                                            <span></span>
                                        @endforelse
                                    </span>
                                    <p class="mini-texts mb-0">
                                        {{ $sermon->description }}
                                    </p>
                                    <h4 class="mini-texts text-muted my-2">
                                        <span><i class="{{ Helper::checkDuration($sermon->created_at) }}"></i> Added {{ $sermon->created_at?$sermon->created_at->diffForHumans():null }}</span>
                                    </h4>
                                    @isTribrid($sermon)
                                        <form class="d-inline mr-1" action="{{ route('sermons.destroy', $sermon->uuid) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <a href="{{ route('sermons.edit', $sermon->uuid) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                    @endisTribrid
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col">
                            <p class="lead my-3">No sermons uploaded yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
