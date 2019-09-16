@section('title', "Edit Event")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Edit Event</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            <form action="{{ route("{$name}.events.update", [$event->uuid_link, $event->id]) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="eventForm">
                                @csrf
                                @method('PUT')
                                @includeIf('components.messages')

                                {{-- import from form execs --}}
                                @includeIf('components.form-execs.events', ['event' => $event])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @section('scripts')
    <script>
        Dropzone.options.eventForm = {
            paramName: 'poster',
            maxFileSize: 10,

        }
    </script>
@endsection --}}
