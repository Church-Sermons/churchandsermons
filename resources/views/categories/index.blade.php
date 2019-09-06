@section('title', 'Categories')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="explore">
        <div class="explore-inner container my-5">
            <div class="row">
                <div class="col">
                    <h2 class="font-weight-bold mb-3 text-center">Categories</h2>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{ route('categories.create') }}">
                                <i class="fas fa-plus mr-1"></i> Add Category
                            </a>
                            @if (count($categories))
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Linked To</th>
                                                <th>Image</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td class="text-capitalize">{{ $category->name }}</td>
                                                    <td class="text-capitalize">{{ $category->linked_to }}</td>
                                                    <td><a href="#">View Image</a></td>
                                                    <td>
                                                        <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-danger"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="lead mt-3">There are no categories added yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
