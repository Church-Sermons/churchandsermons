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
    <div class="section" style="display:none;">
        <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <h4 class="title is-4">Edit Organisation</h4>
                        <hr>
                        <form action="{{ route('organisations.update', $organisation->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="field">
                                <label for="name" class="label">Name</label>
                                <div class="control">
                                    <input type="text" name="name" id="name_id" value="{{ $organisation->name }}" class="input @error('name') is-danger @enderror" autofocus>
                                </div>
                                {{-- <p class="help is-success">Success Message</p> --}}
                            </div>
                            <div class="field">
                                <label for="email" class="label">Email</label>
                                <div class="control">
                                    <input type="email" name="email" id="email_id" value="{{ $organisation->email }}" class="input @error('email') is-danger @enderror">
                                </div>
                            </div>
                            <div class="field">
                                <label for="phone" class="label">Phone</label>
                                <div class="control">
                                    <input type="text" name="phone" id="phone_id" value="{{ $organisation->phone }}" class="input @error('phone') is-danger @enderror">
                                </div>
                            </div>
                            <div class="field">
                                <label for="website" class="label">Website</label>
                                <div class="control">
                                    <input type="text" name="website" id="website" value="{{ $organisation->website }}" class="input @error('website') is-danger @enderror">
                                </div>
                            </div>
                            <div class="field">
                                <label for="address" class="label">Address</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea @error('address') is-danger @enderror" name="address">{{ $organisation->address }}</textarea>
                                </div>
                            </div>
                            <div class="field">
                                    <label for="coordinates" class="label">Coordinates</label>
                                    <div class="control">
                                        <div class="level">
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <input type="text" value="{{ $organisation->lat }}" name="lat" id="latitude @error('lat') is-danger @enderror" class="input" placeholder="Latitude">
                                                    <input type="text" value="{{ $organisation->lon }}" name="lon" id="longitude @error('lon') is-danger @enderror" class="input m-l-5" placeholder="Longitude">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="field">
                                <label for="description" class="label">Description</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea  @error('description') is-danger @enderror" name="description">{{ $organisation->description }}</textarea>
                                </div>
                            </div>
                            @if($categories->count() > 0 && in_array('organisation', $categories->pluck('linked_to')->toArray()))
                            <div class="field">
                                <label for="category" class="label">Category</label>
                                <div class="select is-fullwidth @error('category') is-danger @enderror">
                                    <select name="category" id="category_id">
                                        @foreach ($categories as $category)
                                            @if($category->linked_to == 'organisation')
                                            <option value="{{ $category->id }}" {{ $organisation->category->id == $category->id?'selected':'' }}>{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="field m-b-15 m-t-15">
                                <div class="file @error('logo') is-danger @enderror">
                                    <label class="file-label">
                                        <input type="file" class="file-input" name="logo">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Upload Your Logo
                                            </span>
                                        </span>
                                    </label>
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
