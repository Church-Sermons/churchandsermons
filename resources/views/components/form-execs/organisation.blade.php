@component('components.forms.organisation', [
            'oldCategory' => old('category', $organisation->category_id), 'id' => old('id', $organisation->id)])
    @slot('name')
    {{ old('name', $organisation->name) }}
    @endslot
    @slot('email')
        {{ old('email', $organisation->email) }}
    @endslot
    @slot('website')
        {{ old('website', $organisation->website) }}
    @endslot
    @slot('phone')
        {{ old('phone', $organisation->phone) }}
    @endslot
    @slot('address')
        {{ old('address', $organisation->address) }}
    @endslot
    @slot('latitude')
        {{ old('lat', $organisation->lat) }}
    @endslot
    @slot('longitude')
        {{ old('lon',$organisation->lon) }}
    @endslot
    @slot('description')
        {{ old('description', $organisation->description) }}
    @endslot
    @slot('logo')
        {{ old('logo', $organisation->logo) }}
    @endslot
    @slot('submitButtonText')
        {{ $submitText }}
    @endslot
@endcomponent
