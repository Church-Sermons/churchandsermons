<div class="form-group">
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ $name }}" required>
    @error('name')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="form-group">
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" style="resize: none;" placeholder="Description" required>{{ $description }}</textarea>
    @error('description')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="input-group mb-3">
    @if (Helper::categoryExtractor($categories, 'resource'))
        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
            <option value disabled selected>Select Category</option>
            @foreach ($categories as $category)
                @if ($category->linked_to == 'resource')
                    <option value="{{ $category->id }}" @if($oldCategory == $category->id) selected @endif class="text-capitalize">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    @else
        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
            <option value disabled selected>No category found. Click plus icon to add</option>
        </select>
    @endif
    <div class="input-group-append">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"><i class="fas fa-plus"></i></button>
    </div>
    @error('category')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="form-group">
    <div class="custom-file">
        <input type="file" name="file_name[]" class="custom-file-input @error('file_name') is-invalid @enderror" id="file_name" value="{{ $file }}" multiple>
        <label for="file_name" class="custom-file-label">Upload File</label>
        @error('file_name')
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
