@component('components.forms.profile',
        ['oldCategory' => old('category', $profile->category_id), 'id' => old('id', $profile->id)])
    @slot('name')
        {{ old('name', $profile->name) }}
    @endslot
    @slot('surname')
        {{ old('surname', $profile->surname) }}
    @endslot
    @slot('email')
        {{ old('email', $profile->email) }}
    @endslot
    @slot('website')
        {{ old('website', $profile->website) }}
    @endslot
    @slot('phone')
        {{ old('phone', $profile->phone) }}
    @endslot
    @slot('address')
        {{ old('address', $profile->address) }}
    @endslot
    @slot('latitude')
        {{ old('lat', $profile->lat) }}
    @endslot
    @slot('longitude')
        {{ old('lon', $profile->lon) }}
    @endslot
    @slot('description')
        {{ old('description', $profile->description) }}
    @endslot
    @slot('profile')
        {{ old('profile_image', $profile->profile_image) }}
    @endslot
    <input type="hidden" name="id" id="id" value="{{ $profile->id }}">
    @slot('submitButtonText')
        {{ $submitText }}
    @endslot
@endcomponent
