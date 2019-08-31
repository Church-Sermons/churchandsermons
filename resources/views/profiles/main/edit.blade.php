@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <h4 class="title is-4">Edit Profile</h4>
                        <hr>
                        <form action="{{ route('profiles.update', $profile->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="columns">
                                <div class="column">
                                    <label for="name" class="label">Name</label>
                                    <div class="control">
                                        <input type="text" name="name" id="name" value="{{ $profile->name }}" class="input @error('name') is-danger @enderror" autofocus>
                                    </div>
                                </div>
                                <div class="column">
                                    <label for="surname" class="label">Surname</label>
                                    <div class="control">
                                        <input type="text" name="surname" id="surname" value="{{ $profile->surname }}" class="input @error('surname') is-danger @enderror">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="email" class="label">Email</label>
                                <div class="control">
                                    <input type="email" name="email" id="email_id" value="{{ $profile->email }}" class="input @error('email') is-danger @enderror">
                                </div>
                            </div>
                            <div class="field">
                                <label for="phone" class="label">Phone</label>
                                <div class="control">
                                    <input type="text" name="phone" id="phone_id" value="{{ $profile->phone }}" class="input @error('phone') is-danger @enderror">
                                </div>
                            </div>
                            <div class="field">
                                <label for="website" class="label">Website</label>
                                <div class="control">
                                    <input type="text" name="website" id="website" value="{{ $profile->website }}" class="input @error('website') is-danger @enderror">
                                </div>
                            </div>
                            <div class="field">
                                <label for="address" class="label">Address</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea @error('address') is-danger @enderror" name="address">{{ $profile->address }}</textarea>
                                </div>
                            </div>
                            <div class="field">
                                    <label for="coordinates" class="label">Coordinates</label>
                                    <div class="control">
                                        <div class="level">
                                            <div class="level-left">
                                                <div class="level-item">
                                                    <input type="text" value="{{ $profile->lat }}" name="lat" id="latitude @error('lat') is-danger @enderror" class="input" placeholder="Latitude">
                                                    <input type="text" value="{{ $profile->lon }}" name="lon" id="longitude @error('lon') is-danger @enderror" class="input m-l-5" placeholder="Longitude">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="field">
                                <label for="description" class="label">Description</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea  @error('description') is-danger @enderror" name="description">{{ $profile->description }}</textarea>
                                </div>
                            </div>
                            @if($categories->count() > 0 && in_array('profile', $categories->pluck('linked_to')->toArray()))
                            <div class="field">
                                <label for="category" class="label">Category</label>
                                <div class="select is-fullwidth @error('category') is-danger @enderror">
                                    <select name="category" id="category_id">
                                        @foreach ($categories as $category)
                                            @if($category->linked_to == 'profile')
                                            <option value="{{ $category->id }}" {{ $profile->category->id == $category->id?'selected':'' }}>{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="field m-b-15 m-t-15">
                                <div class="columns">
                                    <div class="column is-one-fifth">
                                        <figure class="image is-128by128">
                                            <img src="{{ asset('storage/'.$profile->profile_image) }}" alt="profile-image">
                                        </figure>
                                    </div>
                                </div>
                                <div class="file @error('profile_image') is-danger @enderror">
                                    <label class="file-label">
                                        <input type="file" value="{{ $profile->profile_image }}" class="file-input" name="profile_image">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Upload Your Profile Image
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
