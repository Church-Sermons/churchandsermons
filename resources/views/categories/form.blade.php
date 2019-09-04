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
        @foreach ($links as $link)
            <option value="{{ $link }}" {{ $linked == $link?'selected':'' }}>{{ $link }}</option>
        @endforeach
    </select>
    @error('linked_to')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>
