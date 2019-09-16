<div class="input-group">
    <div class="custom-file">
        <input type="file" name="slides[]" class="custom-file-input @error('slides') is-invalid @enderror" id="slides" value="{{ $slides }}" multiple>
        <label for="slides" class="custom-file-label">Upload Slides</label>
        @error('slides')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Upload</button>
    </div>
</div>
{{ $slot }}
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
