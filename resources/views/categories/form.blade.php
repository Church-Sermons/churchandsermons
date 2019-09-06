<div class="form-group">
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ $name }}" required>
    @error('name')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="form-group">
    <select name="linked_to" id="linked-to" class="form-control text-uppercase @error('linked_to') is-invalid @enderror" required>
        <option value disabled selected>Select Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent }}" {{ $selected == $parent?'selected':'' }}>{{ $parent }}</option>
        @endforeach
    </select>
    @error('linked_to')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="form-group">
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input image-check" id="imageOption1" data-target="imageId" name="image_option" value="0" @if($imageOption == '0') checked @endif checked>
        <label class="custom-control-label" for="imageOption1">Upload Image</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input image-check" id="imageOption2" data-target="imageUrlId" name="image_option" value="1" @if($imageOption == '1') checked @endif>
        <label class="custom-control-label" for="imageOption2">Use Image Url</label>
    </div>
</div>

<div class="form-group mt-3" id="imageId">
    <div class="custom-file">
        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image" value={{ $image }}>
        <label for="image" class="custom-file-label text-muted image-label">Upload Image For Category Representation</label>
        @error('image')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>

<div class="form-group" id="imageUrlId">
    <input type="url" class="@error('image_url') is-invalid @enderror form-control" name="image_url" placeholder="https://example.com/path/to/image" id="image-url" placeholder="Image Url" pattern="https?://.*" value="{{ $imageUrl }}">
    @error('image_url')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

{{ $slot}}

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
