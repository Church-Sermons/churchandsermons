<div class="form-group">
    <input type="hidden" name="id" value="{{ $id }}">
    <label for="about-description" class="font-weight-bold">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="about-description" name="description" rows="5" style="resize: none;" placeholder="About - Description" required>{{ $description }}</textarea>
    @error('description')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <label for="about-mission" class="font-weight-bold">Mission & Vision</label>
    <textarea class="form-control @error('mission') is-invalid @enderror" id="about-mission" name="mission" rows="5" style="resize: none;" placeholder="Mission & Vision" required>{{ $missionVision }}</textarea>
    @error('mission')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
{{ $slot }}
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
