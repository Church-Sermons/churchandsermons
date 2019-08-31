@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns m-t-50">
        <div class="column is-three-fifths is-offset-one-fifth">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-header-title">
                        {{ $events->first()->organisation->name }} Events
                    </h3>
                </div>
                <div class="card-content">
                    @foreach ($events as $event)
                        <div class="card m-b-30">
                            <div class="card-content is-paddingless">
                                <div class="columns is-paddingless">
                                    <div class="column is-paddingless is-one-fifth has-background-info has-text-centered">
                                        <h3 class="title is-3 has-text-white">{{ Helper::dateFormatter($event->created_at)[1] }}</h3>
                                        <h5 class="subtitle is-5 has-text-white is-uppercase">{{ Helper::dateFormatter($event->created_at)[0] }}</h5>
                                    </div>
                                    <div class="column is-one-fifth is-paddingless">
                                        <figure class="image is-fullwidth">
                                            <img src="{{ asset('/storage/'.$event->poster)}}" alt="event-poster">
                                        </figure>
                                    </div>
                                    <div class="column is-two-fifths is-paddingless m-l-5">
                                        <h4 class="is-6"><small><strong>{{ $event->title }}</strong></small></h4>
                                        <small>
                                            <i class="fas fa-map-marker-alt m-r-5"></i> {{ $event->address }}
                                        </small>
                                        <p class="is-6"><small>{{ str_limit($event->description, 50) }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <style>
    figure{
        position: relative;
    }

    figure::before{
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        content: '';
        background: rgba(0,0, 0, 0.25);
    }
    </style>
@endsection
