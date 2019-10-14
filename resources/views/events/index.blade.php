@section('title', "{$model->name} {$model->surname} Events")

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <div id="explore">
            <div class="explore-inner container my-5">
                <div class="row">
                    <div class="col">
                        <h2 class="font-weight-bold mb-3 text-center">{{ "$model->name $model->surname"}} Events</h2>

                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                @isTribrid($model)
                                    <a href='{{ route("{$name}.events.create", $model->uuid) }}' class="mb-3 d-block btn btn-primary">Add Event</a>
                                @endisTribrid
                                <ul class="nav nav-pills bg-light nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active text-uppercase mini-texts" data-toggle="pill" href="#upcoming">Upcoming Events</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase mini-texts" data-toggle="pill" href="#past">Past Events</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-8 offset-md-2">
                                <div class="container">
                                    @include('components.messages')
                                    <div class="tab-content py-2" >
                                        <div class="tab-pane show fade active" id="upcoming">
                                            @forelse ($model->events as $event)
                                                <div class="card event-card shadow-sm bg-light mb-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-2 pr-2">
                                                                <span class="w-100 h-100 bg-primary text-white rounded p-1 d-flex flex-column align-items-center justify-content-center">
                                                                    <h1 class="font-weight-bold">{{ Helper::dateFormatter($event->created_at)[1] }}</h1>
                                                                    <h5 class="text-capitalize">{{ Helper::dateFormatter($event->created_at)[0] }}</h5>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-10 pl-2">
                                                                <div class="d-flex justify-content-between">
                                                                    <h3 class="h4 mb-1 font-weight-bold w-100">{{ $event->title }}</h3>
                                                                    @isTribrid($model)
                                                                    <span class="w-25 text-right">
                                                                        <form class="d-inline" action="{{ route("$name.events.destroy", [$event->uuid_link, $event->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                                        </form>
                                                                        <a href="{{ route("$name.events.edit", [$event->uuid_link, $event->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                                    </span>
                                                                    @endisTribrid
                                                                </div>
                                                                <p class="mini-texts my-2 lead">
                                                                    <i class="fas fa-map-marker-alt mr-1 text-primary"></i> {{ $event->address }}
                                                                </p>
                                                                <p class="mini-texts mt-1">
                                                                    {{ $event->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="lead">There are no upcoming events</p>
                                            @endforelse
                                        </div>
                                        <div class="tab-pane fade" id="past">
                                            <p class="lead">There are no past events</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
