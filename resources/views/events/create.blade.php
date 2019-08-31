@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <h4 class="title is-4">Create Event</h4>
                        <hr>
                        @if ($errors->any())
                        <div class="message is-danger">
                            <div class="message-header">
                                <h5>Heading</h5>
                                <button class="delete" aria-label="delete"></button>
                            </div>
                            <div class="message-body">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <form action="{{ route('organisations.events.store', $organisation->uuid) }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="field">
                                <label for="title" class="label">Title</label>
                                <div class="control">
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="input @error('title') is-danger @enderror" autofocus>
                                </div>
                                @error('title')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="address" class="label">Address</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea @error('address') is-danger @enderror" name="address" autocomplete="address-line1">{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="coordinates" class="label">Coordinates</label>
                                <div class="control">
                                    <div class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <input type="text" value="{{ old('lat') }}" name="lat" id="latitude @error('lat') is-danger @enderror" class="input" placeholder="Latitude">
                                                <input type="text" value="{{ old('lon') }}" name="lon" id="longitude @error('lon') is-danger @enderror" class="input m-l-5" placeholder="Longitude">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="description" class="label">Description</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea  @error('description') is-danger @enderror" name="description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field m-b-15 m-t-15">
                                <div class="file @error('poster') is-danger @enderror">
                                    <label class="file-label">
                                        <input type="file" class="file-input" name="poster">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Upload Event Poster
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                @error('poster')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button class="button is-fullwidth is-primary is-outlined">
                                        <i class="fas fa-plus m-r-5"></i> Create
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
