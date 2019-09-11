<div class="form-group">
    <input type="password" name="old_password" id="old-password" placeholder="Current Password" class="@error('old_password') is-invalid @enderror form-control" value="{{ $oldPassword }}" required>
    @error('old_password')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
{{ $slot }}
<div class="form-group">
    <input type="password" name="password" id="password" placeholder="New Password" class="@error('password') is-invalid @enderror form-control" value="{{ $password }}" required>
    @error('password')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <input type="password" name="confirm_password" id="confirm-password" placeholder="Confirm New Password" class="@error('confirm_password') is-invalid @enderror form-control" value="{{ $confirmPassword }}" required>
    @error('confirm_password')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
