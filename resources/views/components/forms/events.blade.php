<div class="form-group">
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Event Title" value="{{ $title }}" required>
    @error('title')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="5" style="resize: none;" placeholder="Address" required>{{ $address }}</textarea>
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
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" style="resize: none;" placeholder="Description" required>{{ $description }}</textarea>
    @error('description')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <div class="custom-file">
        <input type="file" name="poster" class="custom-file-input @error('poster') is-invalid @enderror" id="poster" value="{{ $poster }}">
        <label for="poster" class="custom-file-label">Upload Poster</label>
        @error('poster')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
{{ $slot }}
<div class="form-group">
    <button type="submit" class="btn btn-custom">{{ $submitButtonText }}</button>
</div>
