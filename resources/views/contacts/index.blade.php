@section('title', $model->name.__(" Messages"))

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="explore">
        <div class="explore-inner container my-5">
            <div class="row">
                <div class="col">
                    <h2 class="font-weight-bold mb-3 text-center">Messages</h2>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Voluptatem non, quasi aliquid corporis atque, asperiores
                        fuga impedit corrupti autem optio fugit modi accusamus ducimus
                        ut facere. Minus, expedita ut. Odit?
                    </p>
                    <div class="accordion my-3" id="accordionParent">
                        @include('components.messages')

                        @forelse ($model->contacts as $message)
                            <div class="card mb-1 {{ $loop->last?'border':null }}">
                                <div class="card-header d-flex justify-content-between py-1 px-1" id="{{ __('heading').$message->id }}">
                                    <p class="font-weight-bold my-1">
                                        <button class="btn btn-link text-capitalize" data-target="#{{ __('collapse').$message->id }}" data-toggle="collapse" aria-controls="{{ __('collapse').$message->id }}">
                                            {{ $message->message }}
                                        </button>
                                    </p>
                                    <form class="d-inline mr-1 mt-1" action='{{ route("{$name}.contacts.destroy", [$message->uuid_link, $message->id]) }}' method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>

                                </div>
                                <div id="{{ __('collapse').$message->id }}" class="collapse {{ $loop->first?'show':null }}" aria-labelledby="{{ __('heading').$message->id }}" data-parent="#accordionParent">
                                    <div class="card-body">
                                        <h4 class="text-capitalize mb-0 font-weight-bold">{{ $message->subject }}</h4>
                                        <p class="my-1 lead">{{ $message->message }}</p>
                                        <h4 class="mini-texts text-muted">
                                            <span class="text-capitalize mr-1">{{ $message->name }}</span> |
                                            <span class="text-lowercase ml-1">{{ $message->email }}</span>
                                            <span>{{ $message->created_at?__(" | ").$message->created_at->diffForHumans():null}}</span>
                                        </h4>


                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card border">
                                <div class="card-body">
                                    <p class="lead">There are no messages to display</p>
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
