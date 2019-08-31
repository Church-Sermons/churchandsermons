@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
        <div class="columns">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="card">
                    <div class="card-content">
                        <div class="columns">
                            <div class="column is-three-fifths">
                                <h4 class="title is-4">Categories</h4>
                            </div>
                            <div class="column is-two-fifths">
                                <a href="{{ route('categories.create') }}" class="button is-primary is-fullwidth">
                                    <i class="fas fa-plus m-r-5"></i> Create Category
                                </a>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">

                                @if ($categories->count() > 0)
                                <div class="table-container">
                                    <table class="table is-striped is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Linked To</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td><strong>{{ $category->id }}</strong></td>
                                                    <td>{{ ucwords($category->name) }}</td>
                                                    <td>{{ ucwords($category->linked_to) }}</td>
                                                    <td class="has-text-right">
                                                        <a href="{{ route('categories.show', $category->id) }}" class="button is-outlined">View</a>
                                                        <a href="{{ route('categories.edit', $category->id) }}" class="button is-outlined">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <p class="is-danger is-5">There are no categories to display at the moment</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
