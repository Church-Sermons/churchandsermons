@component('components.modal')
    @slot('title')
        Add Category
    @endslot

    <div class="message-area"></div>

    <form action="#" method="post" id="categoryForm">
        @csrf
        @component('categories.form', [
                        'selected' => old('linked_to', $selected),
                        'parents' => $parents,
                        )])
            @slot('name')
                {{ old('name') }}
            @endslot
            @slot('submitButtonText')
                Add Category
            @endslot
        @endcomponent
    </form>
@endcomponent
