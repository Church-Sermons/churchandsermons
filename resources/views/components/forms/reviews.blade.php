<div class="form-group">
    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" style="resize: none;" placeholder="Message" required>{{ $message }}</textarea>
    @error('message')
    <p class="invalid-feedback">
        {{ $message }}
    </p>
    @enderror
</div>
<div class="form-group">
    <div class="my-rating"></div>
    <input type="hidden" name="rating" value="{{ $rating }}" id="rating">
    @error('rating')
    <p class="text-danger small mt-1">
        {{ $message }}
    </p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-custom">{{ $submitButtonText }}</button>
</div>
