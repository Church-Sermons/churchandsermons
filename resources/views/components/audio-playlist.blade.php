<div class="playlist-container w-100">
    <div class="table-responsive">
        <table class="table-hover table mb-0">
            <tbody>
                @forelse ($data as $audio)
                    <tr>
                        <td class="@if($loop->first) active @endif music-card d-flex align-items-center">
                            <div class="col-2 text-center">
                                <h4 class="font-weight-bold">{{ $loop->iteration }}</h4>
                            </div>
                            <div class="col-8">
                                <h6 class="my-1 text-capitalize font-weight-bold w-100" >
                                    <a href="#" class="meta-container"
                                        data-src="{{ $audio->getFullUrl() }}"
                                        data-type="{{ $audio->mime_type }}"
                                        data-title="{{ $audio->getCustomProperty('title')?$audio->getCustomProperty('title'):$audio->name }}"
                                        data-size="{{ $audio->human_readable_size }}"
                                        data-artist="{{ $audio->getCustomProperty('artist')?$audio->getCustomProperty('artist'):$audio->getCustomProperty('description') }}">

                                        {{ $audio->getCustomProperty('title')?$audio->getCustomProperty('title'):$audio->name }}
                                    </a>
                                </h6>
                                <p class="my-1 text-muted text-capitalized w-100">{{ $audio->getCustomProperty('artist')?$audio->getCustomProperty('artist'):$audio->getCustomProperty('description') }}</p>
                            </div>
                            <div class="col-2 text-right">
                                <h4 class="text-muted">{{ $audio->getCustomProperty('duration')?$audio->getCustomProperty('duration'):$audio->human_readable_size }}</h4>
                                <div>
                                    <form class="d-inline" action="{{ route("{$name}.resources.destroy", [$id, $audio->id]) }}" method="POST" class="delete">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <a title="Edit" href="{{ route("{$name}.resources.edit", [$id, $audio->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit edit"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td><i class="fas fa-exclamation-circle mr-1"></i> Playlist Empty. No audio files present</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
