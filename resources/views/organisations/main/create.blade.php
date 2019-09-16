@section('title', 'Create Organisation')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Register Organisation</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.errors')
                            <form action="{{ route('organisations.store') }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="organisationForm">
                                @csrf
                                {{-- imported component --}}
                                @includeIf('components.form-execs.organisation',
                                    ['submitText' => 'Register', 'organisation' => $organisation])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 {{-- Category Modal Partial --}}
 @include('categories.handler', ['parents' => ['organisation'], 'selected' => 'organisation'])
@endsection
@section('scripts')
    <script>
        // Form Persistence
        const organisationForm = document.getElementById('organisationForm');
        FormPersistence.persist(organisationForm, {
            useSessionStorage: true
        });
    </script>
@endsection
