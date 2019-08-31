@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column is-three-fifths">
                                <h4 class="title is-4">Category</h4>
                            </div>
                            <div class="column is-two-fifths">
                                <a href="{{ route('categories.edit', $category->id) }}" class="button is-primary is-fullwidth">
                                    <i class="fas fa-pencil-alt m-r-5"></i> Edit Category
                                </a>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <h4 class="title">{{ $category->name }}</h4>
                                <h6 class="subtitle">{{ $category->linked_to }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
