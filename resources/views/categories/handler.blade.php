@component('components.modal')
    @slot('title')
        Add Profile Category
    @endslot

    <div class="message-area"></div>

    <form action="#" method="post" id="categoryForm">
        @csrf
        @component('categories.form', [
                        'linked' => old('linked_to', $category),
                        'links' => [$category]])
            @slot('name')
                {{ old('name') }}
            @endslot
            @slot('submitButtonText')
                Add Category
            @endslot
        @endcomponent
    </form>
@endcomponent
