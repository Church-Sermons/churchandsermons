@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-10 m-l-20">
        <div class="columns">
            <div class="column">
                <h3 class="title">Manage Permissions</h3>
            </div>
            <div class="column">
                <a href="{{ route('permissions.create')}}" class="button is-primary is-pulled-right">
                    <i class="fas fa-user-add"></i> Create New Permission
                </a>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="table-container">
                        <table class="table is-striped is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td><strong>{{ ucwords($permission->display_name) }}</strong></td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->description }}</td>
                                        <td>
                                            <a href="{{ route('permissions.show', $permission->id) }}" class="button is-outlined">View</a>
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="button is-outlined">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper">
            {{ $permissions->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>
@endsection
