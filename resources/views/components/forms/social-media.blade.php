@foreach ($sites as $site)
    <div class="form-row">
        <div class="form-group col-md-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="social-id-{{ $loop->index }}" name="social_id[]" value='{{ "{$site->id}-{$loop->index}" }}' >
                <label class="custom-control-label text-capitalize" for="social-id-{{ $loop->index }}">{{ $site->name }}</label>
            </div>
        </div>
        <div class="form-group col-md-9">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="url" placeholder="Social Media Link" class="form-control" name="page_link[]" id="page-link-{{ $loop->index }}" pattern="https?://.*">
                </div>
                <div class="form-group col-md-12">
                    <input type="url" placeholder="Social Media Share Link" class="form-control" name="share_link[]" id="share-link-{{ $loop->index }}" pattern="https?://.*">
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="form-group">
    <button class="btn btn-primary" type="submit">{{ $submitText }}</button>
</div>
