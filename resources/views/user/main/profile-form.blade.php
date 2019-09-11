<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" class="@error('name') is-invalid @enderror form-control" name="name" id="name" placeholder="Your Name" value="{{ $name }}" required>
        @error('name')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="text" class="@error('surname') is-invalid @enderror form-control" name="surname" id="surname" placeholder="Your Surname" value="{{ $surname }}">
        @error('surname')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-group">
    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" value="{{ $email }}" required>
    @error('email')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="5" style="resize: none;" placeholder="Address">{{ $address }}</textarea>
    @error('address')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <div class="custom-file">
        <input type="file" name="profile_image" class="custom-file-input @error('profile_image') is-invalid @enderror" id="profile-image" value="{{ $profile }}">
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
