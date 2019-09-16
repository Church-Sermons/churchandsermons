<div class="form-row">
    <div class="form-group col-md-6">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name*" value="{{ $name }}" required>
        @error('name')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="surname" placeholder="Surname*" value="{{ $surname }}" required>
        @error('surname')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>

<div class="form-group">
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address*" value="{{ $email }}" required>
    @error('email')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="https://example.com" pattern="https?://.*" value="{{ $website }}">
        @error('website')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone: 123-456-7890*" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3,4}" minlength="10" maxlength="15" value="{{ $phone }}" required/>
        @error('phone')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-group">
    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="5" style="resize: none;" placeholder="Address*" required>{{ $address }}</textarea>
    @error('address')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" name="lat" class="form-control @error('lat') is-invalid @enderror" id="latitude" placeholder="Latitude" value="{{ $latitude }}">
        @error('lat')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="lon" name="lon" class="form-control @error('lon') is-invalid @enderror" id="longitude" placeholder="Longitude" value="{{ $longitude }}">
        @error('lon')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-group">
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" style="resize: none;" placeholder="Description*" required>{{ $description }}</textarea>
    @error('description')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="input-group mb-3">
    @if (Helper::categoryExtractor($categories, 'profile'))
        <select name="category" id="category" class="text-capitalize form-control @error('category') is-invalid @enderror" required>
            <option value disabled selected>Select Category*</option>
            @foreach ($categories as $category)
                @if ($category->linked_to == 'profile')
                    <option value="{{ $category->id }}" @if($oldCategory == $category->id) selected @endif>{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    @else
        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
            <option value disabled selected>No category found. Click plus icon to add</option>
        </select>
    @endif
    <div class="input-group-append">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"><i class="fas fa-plus"></i></button>
    </div>
    @error('category')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <div class="custom-file">
        <input type="file" name="profile_image" class="custom-file-input @error('profile_image') is-invalid @enderror" id="profile_image" value="{{ $profile }}">
        <label for="profile_image" class="custom-file-label">Upload Profile Image</label>
        @error('profile_image')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
{{ $slot }}
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
