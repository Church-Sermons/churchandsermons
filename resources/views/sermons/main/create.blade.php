@section('title', "Create Sermon")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Add Sermon</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.messages')
                            @include('components.errors')
                            <form action="{{ route("sermons.store") }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="sermonForm">
                                @csrf

                                @component('sermons.main.form', ['oldCategory' => old('category'), 'speakers' => $speakers, 'selected' => old('speakers', [])])
                                    @slot('title')
                                        {{ old('title') }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description') }}
                                    @endslot
                                    @slot('file')
                                        {{ old('file_name') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Add Sermon
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
{{-- Category Modal Partial --}}
@include('categories.handler', ['parents' => ['resource'], 'selected' => 'resource'])
@endsection

@section('scripts')
    <script>


        // Form Persistence
        const profileForm = document.getElementById('sermonForm');
        FormPersistence.persist(profileForm, {
            useSessionStorage: true
        });


    </script>
@endsection
