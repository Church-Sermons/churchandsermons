@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-15" id="user-form">
    <div class="columns">
        <div class="column is-two-thirds">
            <h3 class="title">Edit Permission</h3>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <form action="{{ route('permissions.update', $permission->id ) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="field">
                    <label for="display_name" class="label">Name (Display Name)</label>
                    <div class="control ">
                        <input type="text" class="input" name="display_name" value="{{ $permission->display_name }}">
                    </div>
                </div>

                <div class="field">
                    <label for="slug" class="label">Slug</label>
                    <div class="control">
                        <input type="text" class="input" name="name" value="{{ $permission->name }}" readonly>
                    </div>
                </div>

                <div class="field">
                    <label for="description" class="label">Description</label>
                    <div class="control">
                        <input type="text" class="input" name="description" id="description" value="{{ $permission->description }}">
                    </div>
                </div>
                <div class="field m-t-10">
                    <div class="control">
                        <button class="button is-primary is-outlined">Edit Permission</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

