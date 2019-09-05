<audio class="media-player" id="audio-player" controls>
    @forelse ($data as $audio)
        @if ($loop->first)
            <source src="{{ $audio->getUrl() }}" type="{{ $audio->mime_type }}" />
        @endif
        <source src="{{ $audio->getUrl() }}" type="{{ $audio->mime_type }}" />
    @empty
        <source src="/path/to/audio.mp3" type="audio/mpeg" />
    @endforelse
</audio>
