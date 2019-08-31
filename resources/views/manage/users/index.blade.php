@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-10 m-l-20">
    <div class="columns">
        <div class="column">
            <h3 class="title">Manage Users</h3>
        </div>
        <div class="column">
            <a href="{{ route('users.create')}}" class="button is-primary is-pulled-right">
                <i class="fas fa-user-plus m-r-5"></i> Create New User
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
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><strong>{{ $user->id }}</strong></td>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                    <td class="has-text-right">
                                        <a href="{{ route('users.show', $user->id) }}" class="button is-outlined">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="button is-outlined">Edit</a>
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
        {{ $users->links('vendor.pagination.custom-pagination') }}
    </div>
</div>
@endsection
