@component('components.modal', ['header' => false, 'title' => false, 'size' => 'modal-lg'])
    <video poster="#" id="video-player" playsinline controls>
        <source src="#" type="#" />
        {{-- <source src="/path/to/video.webm" type="video/webm" /> --}}

        <!-- Captions are optional -->
        {{-- <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default /> --}}
    </video>
    {{ $slot }}
@endcomponent
