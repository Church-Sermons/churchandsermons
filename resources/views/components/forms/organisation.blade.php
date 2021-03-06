<div class="form-row">
    <div class="form-group col-md-6">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name*" value="{{ $name }}" required>
        @error('name')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address*" value="{{ $email }}" required>
        @error('email')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="https://example.com" pattern="https?://.*" value="{{ $website }}">
        @error('website')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone: 123-456-7890*" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3,4}" minlength="10" maxlength="15" value="{{ $phone }}" required/>
        @error('phone')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-group">
    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="5" style="resize: none;" placeholder="Address*" required>{{ $address }}</textarea>
    @error('address')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" name="lat" class="form-control @error('lat') is-invalid @enderror" id="latitude" placeholder="Latitude" value="{{ $latitude }}">
        @error('lat')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <input type="lon" name="lon" class="form-control @error('lon') is-invalid @enderror" id="longitude" placeholder="Longitude" value="{{ $longitude }}">
        @error('lon')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-group">
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" style="resize: none;" placeholder="Description*" required>{{ $description }}</textarea>
    @error('description')
        <p class="invalid-feedback">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="input-group mb-3">
    @if (Helper::categoryExtractor($categories, 'organisation'))
        <select name="category" id="category" class="text-capitalize form-control @error('category') is-invalid @enderror" required>
            <option value disabled selected>Select Category*</option>
            @foreach ($categories as $category)
                @if ($category->linked_to == 'organisation')
                    <option value="{{ $category->id }}" @if($oldCategory == $category->id) selected @endif>{{ $category->name }}</option>
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
        <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo" value="{{ $logo }}">
        <label for="logo" class="mr-1 custom-file-label">Upload Logo</label>
        @error('logo')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
{{-- <div class="form-group">
    <div class="custom-file">
        <input type="file" name="slides[]" class="custom-file-input @error('slides') is-invalid @enderror" id="slides" value="{{ $slides }}" multiple>
        <label for="slides" class="custom-file-label">Upload Slide Images</label>
        @error('slides')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div> --}}
{{-- <div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <select name="social_id" id="social-id" class="form-control text-capitalize @error('social_id') is-invalid @enderror">
                <option value disabled selected>Select Social Site</option>
                @foreach ($sites as $site)
                    <option value="{{ $site->id }}" {{ $site->id == $socialId?'selected':null }}>{{ $site->name }}</option>
                @endforeach
            </select>
            @error('social_id')
                <p class="invalid-feedback">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <input type="url" name="page_link" class="form-control @error('page_link') is-invalid @enderror" id="page-link" placeholder="Social Page Link" pattern="https?://.*" value="{{ $pageLink }}">
        @error('page_link')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
        <input type="url" name="share_link" class="form-control @error('share_link') is-invalid @enderror" id="share-link" placeholder="Social Share Link" pattern="https?://.*" value="{{ $shareLink }}">
        @error('share_link')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
<div class="form-group" id="working-hours">
    <div class="d-flex justify-content-between mb-3">
        <span class="font-weight-bold">
            Work Schedule <small class="text-muted">(click button on the right to add variations of your working days)</small>
        </span>
        <button type="button" id="input-generator" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
    </div>
</div> --}}
{{ $slot }}
<div class="form-group">
    <button type="submit" class="btn btn-custom">{{ $submitButtonText }}</button>
</div>
