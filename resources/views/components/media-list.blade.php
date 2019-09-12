@foreach (Auth::user()->getMedia($type) as $media)
<tr class="row">
    {{-- <td class="col-md-1">
        <form class="d-flex justify-content-center">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="resource{{ $media->id }}" name="example1">
                <label class="custom-control-label" for="resource{{ $media->id }}"></label>
            </div>
        </form>
    </td> --}}
    <td class="col-md-1 d-flex justify-content-center">
        @if (strpos($type, 'video') !== false)
            <img src="{{ asset('images/app/defaults/video.svg') }}" alt="{{ $media->name }}" height="50" width="50">
        @elseif(strpos($type, 'document') !== false)
            <img src="{{ asset('images/app/defaults/file.svg') }}" alt="{{ $media->name }}" height="50" width="50">
        @elseif(strpos($type, 'audio') !== false)
            <img src="{{ asset('images/app/defaults/musical-note.svg') }}" alt="{{ $media->name }}" height="50" width="50">
        @elseif(strpos(explode("/", $media->mime_type)[0], 'image') !== false)
            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" height="50" width="50">
        @else
            <div class="text-center">
                <i class="far fa-file fa-4x"></i>
            </div>
        @endif
    </td>
    <td class="align-middle col-md-6">
        <h5 class="font-weight-bold"><a href="{{ route('resources.show', $media->id) }}">{{ $media->name }}</a></h5>
        <h6>{{ $media->file_name }}</h6>
    </td>
    <td class="col-md-1">
        <h6 class="text-uppercase">{{ explode("/", $media->mime_type)[0] }}</h6>
    </td>
    <td class="col-md-1">
        <h6 class="text-muted text-uppercase">{{ $media->human_readable_size }}</h6>
    </td>
    <td class="col-md-2">
        <h6>{{ $media->created_at?$media->created_at->diffForHumans():null }}</h6>
    </td>
    <td class="col-md-1">
        <form action="{{ route('resources.destroy', $media->id)}}" method="post" class="mb-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <a href="{{ route('resources.edit', $media->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
    </td>
</tr>
@endforeach
