<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ $name }}" required>
        @error('name')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" value="{{ $email }}" required>
        @error('email')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
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
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
