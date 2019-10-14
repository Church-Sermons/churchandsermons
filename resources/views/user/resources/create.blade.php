"@section('title',"Add Resource For ".Auth::user()->name." ".Auth::user()->surname)

@extends('layouts.app')

@section('content')
@include('_partials.nav.sidenav')
<div id="safeguard">
    <div id="main">
        <div class="container main-inner py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Add Resource</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.messages')
                            <form action="{{ route('resources.store') }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="resourcesForm">
                                @csrf
                                @component('resources.form', ['categories' => $categories, 'oldCategory' => old('category')])
                                    @slot('name')
                                        {{ old('name') }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description') }}
                                    @endslot
                                    @slot('file')
                                        {{ old('file_name') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Add Resource
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
        const resourcesForm = document.getElementById('resourcesForm');
        FormPersistence.persist(resourcesForm, {
            useSessionStorage: true
        });
    </script>
@endsection
