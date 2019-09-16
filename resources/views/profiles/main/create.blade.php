@section('title', 'Create Profile')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Create Profile</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.messages')
                            <form action="{{ route('profiles.store') }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="profileForm">
                                @csrf
                                {{-- import from form execs --}}
                                @includeIf('components.form-execs.profile',
                                    ['submitText' => 'Create Profile', 'profile' => $profile ])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Category Modal Partial --}}
@include('categories.handler', ['parents' => ['profile'], 'selected' => 'profile'])
@endsection

@section('scripts')
    <script>


        // Form Persistence
        const profileForm = document.getElementById('profileForm');
        FormPersistence.persist(profileForm, {
            useSessionStorage: true
        });


    </script>
@endsection
