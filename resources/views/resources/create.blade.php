"@section('title',"Add Resource For {$model->name} {$model->surname}")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
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
                            <form action="{{ route("{$name}.resources.store", $model->uuid) }}"
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

