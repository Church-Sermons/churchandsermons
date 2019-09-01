@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-two-thirds is-offset-one-quarter">
                <div class="card">
                    <div class="card-content">
                        <form action="{{ route('organisations.resources.store', $organisation->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="field">
                            <label for="name" class="label">Name</label>
                            <div class="control">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="input @error('name') is-danger @enderror" autocomplete="name" autofocus>
                            </div>
                            @error('name')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="description" class="label">Description</label>
                            <div class="control">
                                <textarea rows="5" class="textarea  @error('description') is-danger @enderror" name="description">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if($categories->count() > 0 && in_array('resource', $categories->pluck('linked_to')->toArray()))
                            <label for="category" class="label">Category</label>
                            <div class="field has-addons">
                                <div class="control is-expanded">
                                    <div class="select is-fullwidth @error('category') is-danger @enderror">
                                        <select name="category" id="category_id">
                                            @foreach ($categories as $category)
                                                @if($category->linked_to == 'resource')
                                                <option value="{{ $category->id }}" {{ old('category') == $category->id?'selected':'' }}>{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('category')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                                <div class="control">
                                    <a href="#" class="button is-primary category-toggler"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            @else
                            <div class="field">
                                <p class="has-text-danger is-6">No categories created yet! <strong>Required</strong></p>
                                <div class="control">
                                    <a href="#" class="button is-small m-t-5 is-outlined is-primary category-toggler">Create Category</a>
                                </div>
                            </div>
                            @endif
                            <div class="field m-b-15 m-t-15">
                                <div class="file @error('file_name') is-danger @enderror is-fullwidth">
                                    <label class="file-label">
                                        <input type="file" class="file-input" name="file_name">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Upload Your File
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                @error('file_name')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button class="button is-fullwidth is-primary is-outlined">
                                        <i class="fas fa-plus m-r-5"></i> Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@component('components.modal')
        @slot('col')
            is-one-third is-offset-one-third
        @endslot

        @slot('title')
            Create Category
        @endslot
        <form action="{{ route('categories.store') }}" method="post" id="categoryForm">
            @csrf
            <div class="field">
                <label for="category" class="label">Name</label>
                <div class="control">
                    <input type="text" name="name" id="name" class="input" placeholder="Category Name" required>
                </div>
            </div>

            <div class="field">
                <label for="category" class="label">Linked To</label>
                <div class="control">
                    <input type="text" name="linked_to" id="linked_to" class="input" value="resource" readonly>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-fullwidth is-primary is-outlined">
                        <i class="fas fa-plus m-r-5"></i> Create
                    </button>
                </div>
            </div>
            <ul class="error-display">
                <li>
                    <p class="has-text-danger error-text"></p>
                </li>
            </ul>
        </form>
    @endcomponent
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const categoryTogger = document.querySelector('.category-toggler');
    const modalContainer = document.querySelector('#modalContainer');
    const close = document.querySelector('.close');

    categoryTogger.addEventListener('click', function(e){
        e.preventDefault();
        // open modal
        modalContainer.style.display = 'block';

    });

    // close modal on close button click
    close.addEventListener('click', function(e){
        e.preventDefault();
        modalContainer.style.display = 'none';
    });

    // close modal onclick anywhere outside modal
    window.addEventListener('click', function(e){
        if(e.target == modalContainer){
            modalContainer.style.display = 'none';
        }
    })

    // submit category form
    const categoryForm = document.querySelector('#categoryForm');

    categoryForm.addEventListener('submit', function(e){
        e.preventDefault();

        const formData = new FormData(e.target);

        if(!formData.get('name')){
            document.querySelector('.error-display').style.display = 'block';
            // display error message
            document.querySelector('.error-text').innerHTML = 'Category Name is required';

        }else if(formData.get('name').length > 255){
            document.querySelector('.error-display').style.display = 'block';
            // check size
            document.querySelector('.error-text').innerHTML = 'Maximum Category Name length is 255 chars';

        }else{
            // make request to server
            const categoryName = formData.get('name');
            const linkedTo = formData.get('linked_to');

            // submit to server
            storeCategories({
                name: categoryName,
                linked_to: linkedTo
            });
        }
    });

    // async function axios
    async function storeCategories(categoryData){
        try {
            const response = await axios.post('{{ route('categories.storejson') }}', categoryData);
            const { data } = response;

            // display message
            alert(data.message);
            // reload page
            window.location.reload();

        } catch (error) {
            console.log(error);
        }
    }

    // merge protocol with site

})
</script>

@endsection
