@section('title', 'Edit Category')

@extends('layouts.app')

@section('content')
@php
    $parents = ['organisation', 'resource', 'profile']
@endphp
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Edit Category</h2>

                            <form action="{{ route('categories.update', $category->id) }}" method="post" class="py-2">
                                @csrf
                                @method('PUT')
                                @component('components.messages')@endcomponent
                                @component('categories.form', [
                                                'selected' => old('linked_to', $category->linked_to),
                                                'parents' => $parents,
                                                ])
                                    @slot('name')
                                        {{ old('name', $category->name) }}
                                    @endslot

                                    @slot('submitButtonText')
                                        Edit Category
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

    <div class="section d-none">
        <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <h4 class="title is-4">Edit Category</h4>
                        <hr>
                        <form action="{{ route('categories.update', $category->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="field">
                                <label for="name" class="label">Name</label>
                                <div class="control">
                                    <input type="text" name="name" id="name_id" value="{{ $category->name }}" class="input">
                                </div>
                            </div>
                            <div class="field">
                                <label for="linked_to" class="label">Linked To</label>
                                <div class="select is-fullwidth">
                                    <select name="linked_to" id="linked_to_id">
                                        <option value="organisation" {{ $category->linked_to == 'organisation'?'selected':'' }}>Organisation</option>
                                        <option value="profile" {{ $category->linked_to == 'profile'?'selected':'' }}>Profile</option>
                                        <option value="resource" {{ $category->linked_to == 'resource'?'selected':'' }}>Resource</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button class="button is-fullwidth is-primary is-outlined">
                                        <i class="fas fa-plus m-r-5"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
