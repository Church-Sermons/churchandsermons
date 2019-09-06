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
                            <h2 class="card-title font-weight-bold mb-3 text-center">Add Category</h2>

                            <form action="{{ route('categories.store') }}" method="post" class="py-2">
                                @csrf
                                @component('components.messages')@endcomponent
                                @component('categories.form', [
                                                'selected' => old('linked_to'),
                                                'parents' => $parents,
                                                'imageOption' => old('imageOption')])
                                    @slot('name')
                                        {{ old('name') }}
                                    @endslot
                                    @slot('image')
                                        {{ old('image') }}
                                    @endslot
                                    @slot('imageUrl')
                                        {{ old('image_url') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Add Category
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
