@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <h4 class="title is-4">Create Category</h4>
                        <hr>
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="field">
                                <label for="name" class="label">Name</label>
                                <div class="control">
                                    <input type="text" name="name" id="name_id" class="input">
                                </div>
                            </div>
                            <div class="field">
                                <label for="linked_to" class="label">Linked To</label>
                                <div class="select is-fullwidth">
                                    <select name="linked_to" id="linked_to_id">
                                        <option value="organisation" selected>Organisation</option>
                                        <option value="profile">Profile</option>
                                        <option value="resource">Resource</option>
                                    </select>
                                </div>
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
