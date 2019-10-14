@section('title', "Edit {$resource->name}")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Edit Resource</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.messages')
                            <form action="{{ route("{$name}.resources.update", [$uuid, $resource->id]) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="resourcesForm">
                                @csrf
                                @method('PUT')
                                @component('resources.form', ['categories' => $categories, 'oldCategory' => old('category', $resource->getCustomProperty('category'))])
                                    @slot('name')
                                        {{ old('name', $resource->getCustomProperty('name')) }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description', $resource->getCustomProperty('name')) }}
                                    @endslot
                                    @slot('file')
                                        {{ old('file_name', $resource->file_name) }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Edit Resource
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
