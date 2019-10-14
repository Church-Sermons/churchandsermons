@component('components.forms.events')
    @slot('title')
        {{ old('title', $event->title) }}
    @endslot
    @slot('address')
        {{ old('address', $event->address) }}
    @endslot
    @slot('latitude')
        {{ old('lat', $event->lat) }}
    @endslot
    @slot('longitude')
        {{ old('lon', $event->lon) }}
    @endslot
    @slot('description')
        {{ old('description', $event->description) }}
    @endslot
    @slot('poster')
        {{ old('poster', $event->poster) }}
    @endslot
    @slot('submitButtonText')
        Update Event
    @endslot
@endcomponent
