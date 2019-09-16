@section('title', __("Reviews For ").$model->name)

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Honesty. Please</h2>
                            <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p>
                            <form action="{{ route("{$name}.reviews.store", $model->uuid) }}" method="post" class="py-2">
                                @csrf
                                @component('components.messages')@endcomponent
                                @component('components.forms.reviews')
                                    @slot('rating')
                                        {{ old('rating') }}
                                    @endslot
                                    @slot('message')
                                        {{ old('message') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Submit Review
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </div>

                    {{-- Review Messages --}}
                    <hr>
                    <div class="card border-0">
                        <div class="card-body p-0">
                            @forelse ($model->reviews as $review)
                                <div class="media mb-3 bg-light rounded p-2">
                                    <img src="https://via.placeholder.com/64" class="rounded-circle mr-2" alt="avatar-image" height="64" width="64">
                                    <div class="media-body d-flex justify-content-between">
                                        <div>
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
                                        @hasRoleAndOwns(['administrator', 'author', 'superadministrator'], $review)
                                            <form class="d-inline mr-1 mt-1" action="{{ route('organisations.reviews.destroy', [$review->uuid_link, $review->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endOwns
                                    </div>
                                </div>
                            @empty
                                <p class="lead">No reviews to display</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        const ratingEl = document.querySelector('#rating');
        $('.my-rating').starRating({
            starSize: 20,
            callback: function(currentRating, $el){
                // set value of hidden to current rating
                ratingEl.value = currentRating;
            }
        })
    </script>
@endsection
