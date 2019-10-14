<div class="form-group">
    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Subject" value="{{ $subject }}" required>
    @error('subject')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" style="resize: none;" placeholder="Message" required>{{ $message }}</textarea>
    @error('message')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-custom">{{ $submitButtonText }}</button>
</div>
