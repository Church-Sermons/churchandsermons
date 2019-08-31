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
                        @if($categories->count() > 0 && in_array('resource', $categories->pluck('linked_to')->toArray()))
                            <div class="field">
                                <label for="category" class="label">Category</label>
                                <div class="select is-fullwidth @error('category') is-danger @enderror">
                                    <select name="category" id="category_id">
                                        @foreach ($categories as $category)
                                            @if($category->linked_to == 'resource')
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id?'selected':'' }}>{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            @endif
                            <div class="field">
                                <label for="description" class="label">Description</label>
                                <div class="control">
                                    <textarea rows="5" class="textarea  @error('description') is-danger @enderror" name="description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field m-b-15 m-t-15">
                                <div class="file @error('file_name') is-danger @enderror">
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

@endsection
