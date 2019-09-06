@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Edit {{ $organisation->name }}</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}

                            <form action="{{ route('organisations.update', $organisation->uuid) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="organisationForm">
                                @csrf
                                @method('PUT')
                                @component('organisations.main.form', ['categories' => $categories, 'oldCategory' => old('category', $organisation->category_id)])
                                    @slot('name')
                                        {{ old('name', $organisation->name) }}
                                    @endslot
                                    @slot('email')
                                        {{ old('email', $organisation->email) }}
                                    @endslot
                                    @slot('website')
                                        {{ old('website', $organisation->website) }}
                                    @endslot
                                    @slot('phone')
                                        {{ old('phone', $organisation->phone) }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address', $organisation->address) }}
                                    @endslot
                                    @slot('latitude')
                                        {{ old('lat', $organisation->lat) }}
                                    @endslot
                                    @slot('longitude')
                                        {{ old('lon',$organisation->lon) }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description', $organisation->description) }}
                                    @endslot
                                    @slot('logo')
                                        {{ old('logo', $organisation->logo) }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Edit Organisation
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
@include('categories.handler', ['parents' => ['organisation'], 'selected' => 'organisation'])

@endsection
