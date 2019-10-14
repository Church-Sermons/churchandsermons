<div class="form-group">
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Sermon Title" value="{{ $title }}" required>
    @error('title')
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
    <div class="custom-file">
        <input type="hidden" value="{{ $file }}" name="file_id">
        <input type="file" name="file_name" class="custom-file-input @error('file_name') is-invalid @enderror" id="file_name" value="{{ $file }}">
        <label for="file_name" class="custom-file-label">Upload File</label>
        @error('file_name')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="input-group-append">
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
    </div>
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
    <div class="d-flex justify-content-between mb-3">
        <span class="font-weight-bold">
            Speakers
        </span>
        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create New Speaker</button>
    </div>
    <select name="speakers[]" id="speakers" class="@error('speakers') is-invalid @enderror form-control text-capitalize" multiple required>
        @if (count($speakers))
            <option value disabled selected>Select Speaker From List</option>
            @foreach ($speakers as $speaker)
                <option value="{{ $speaker->id }}" {{ count($selected)?in_array($speaker->id, $selected)?'selected':null:null }}>{{ "{$speaker->name} {$speaker->surname}" }}</option>
            @endforeach
        @else
            <option value disabled selected>No Speaker Found. Please Add To Proceed</option>
        @endif
    </select>
    @error('speakers')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
{{ $slot }}
<div class="form-group">
    <button type="submit" class="btn btn-custom">{{ $submitButtonText }}</button>
</div>
