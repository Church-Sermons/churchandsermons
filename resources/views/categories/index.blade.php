@section('title', 'Categories')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="explore">
        <div class="explore-inner container my-5">
            <div class="row">
                <div class="col">
                    <h2 class="font-weight-bold mb-3 text-center">Categories</h2>
                    @component('components.messages')@endcomponent
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{ route('categories.create') }}">
                                <i class="fas fa-plus mr-1"></i> Add Category
                            </a>
                            @if (count($categories))
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Linked To</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td class="text-capitalize">{{ $category->name }}</td>
                                                    <td class="text-capitalize">{{ $category->linked_to }}</td>
                                                    <td class="text-right w-25">
                                                        <form class="d-inline mr-1 mt-1" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                        <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
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
