
@section('title', $model->name.__(" Reviews"))

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="explore">
        <div class="explore-inner container my-5">
            <div class="row">
                <div class="col">
                    <h2 class="font-weight-bold mb-3 text-center">Reviews</h2>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Voluptatem non, quasi aliquid corporis atque, asperiores
                        fuga impedit corrupti autem optio fugit modi accusamus ducimus
                        ut facere. Minus, expedita ut. Odit?
                    </p>
                    <div class="accordion my-3" id="accordionParent">
                        @includeIf('components.messages')

                        @forelse ($model->reviews as $review)
                            <div class="card mb-1 {{ $loop->last?'border':null }}">
                                <div class="card-header d-flex justify-content-between py-1 px-1" id="{{ __('heading').$review->id }}">
                                    <p class="font-weight-bold my-1">
                                        <button class="btn btn-link text-capitalize" data-target="#{{ __('collapse').$review->id }}" data-toggle="collapse" aria-controls="{{ __('collapse').$review->id }}">
                                            {{ $review->message }}
                                        </button>
                                    </p>
                                    <form class="d-inline mr-1 mt-1" action='{{ route("{$name}.reviews.destroy", [$review->uuid_link, $review->id]) }}' method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                                <div id="{{ __('collapse').$review->id }}" class="collapse {{ $loop->first?'show':null }}" aria-labelledby="{{ __('heading').$review->id }}" data-parent="#accordionParent">
                                    <div class="card-body">
                                        <div class="media">
                                            <img src="https://via.placeholder.com/64" class="rounded-circle mr-2" alt="avatar-image" height="64" width="64">
                                            <div class="media-body">
                                                <span>
                                                    @forelse (Helper::starRating($review->rating) as $rating)
                                                        <i class="{{ $rating }}"></i>
                                                    @empty
                                                        <i class="o"></i>
                                                    @endforelse
                                                </span>
                                                <h5 class="font-weight-bold mb-1 text-capitalize">{{ $review->user->name }}</h5>
                                                <p class="my-1">{{ $review->message }}</p>
                                                <h6 class="text-muted mini-texts mt-1"><i class="mr-1 {{ Helper::checkDuration($review->created_at) }}"></i>{{ $review->created_at?$review->created_at->diffForHumans():null }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card border">
                                <div class="card-body">
                                    <p class="lead">There are no reviews to display</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
