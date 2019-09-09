@section('title', "Create Event")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Add Event</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.messages')
                            <form action="{{ route("$name.events.store", $model->uuid) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="eventForm">
                                @csrf

                                @component('events.form')
                                    @slot('title')
                                        {{ old('title') }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address') }}
                                    @endslot
                                    @slot('latitude')
                                        {{ old('lat') }}
                                    @endslot
                                    @slot('longitude')
                                        {{ old('lon') }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description') }}
                                    @endslot
                                    @slot('poster')
                                        {{ old('poster') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Add Event
                                    @endslot
                                @endcomponent
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
