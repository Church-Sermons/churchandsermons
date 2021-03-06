@section('title', 'Organisations')

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
                        @auth
                            <a href="{{ route('organisations.create') }}" class="btn btn-custom btn-lg text-uppercase">
                                <i class="fas fa-plus"></i> register organisation
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="explore">

        <div class="container explore-inner py-5">
            @include('components.messages')
            <div class="row">
                @forelse ($organisations as $organisation)
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                        <div class="card bg-light h-100">
                            <div class="card-image-handler">
                                @if (Handler::getPath($organisation->logo)->displayImage())
                                    <img src="{{ Handler::getPath($organisation->logo)->displayImage() }}" alt="{{ $organisation->name.__("-Logo") }}" class="w-100 h-100">
                                @else
                                    <h1 class="display-1 text-white font-weight-bolder bg-info d-flex justify-content-center align-items-center h-100">
                                        {{ strtoupper(substr($organisation->name, 0, 1)) }}
                                    </h1>
                                @endif
                                <div class="card-image-overlay rounded-top d-flex align-items-start justify-content-end p-3">
                                    @isTribrid($organisation)
                                        <form class="d-inline mr-1" action="{{ route('organisations.destroy', $organisation->uuid) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <a href="{{ route('organisations.edit', $organisation->uuid) }}" class="btn btn-custom" title="Edit"><i class="fas fa-edit"></i></a>
                                    @endisTribrid
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
                                    {{ substr($organisation->description,0, 300).__(" ...") }}
                                </p>
                                <span class="d-block w-100 border"></span>
                                <span class="my-2 d-block align-items-center">
                                    @forelse (Helper::starRating($organisation->average_review) as $rating)
                                        <i class="{{ $rating }}"></i>
                                    @empty
                                        <span>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
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
            {{-- Pagination Links --}}
            {{ $organisations->links() }}
        </div>
    </section>
</div><!-- End of safeguard wrapper -->
@endsection
