@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-15">
    <div class="columns">
        <div class="column">
            <h3 class="title">User Details</h3>
        </div>
        <div class="column">
                <a href="{{ route('users.edit', $user->id )}}" class="button is-primary is-pulled-right">
                    <i class="fas fa-user-edit m-r-5"></i> Edit User
                </a>
            </div>
    </div>
    <div class="columns">
        <div class="column is-two-thirds ">
            <div class="card">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <h5 class="title is-5">Name</h5>
                            <h6 class="subtitle is-6">{{ $user->name }}</h6>
                            <h5 class="title is-5 m-t-5">Email</h5>
                            <h6 class="subtitle is-6">{{ $user->email }}</h6>
                            <h5 class="title is-5 m-t-5">Roles</h5>
                            @if ($user->roles->count() > 0)
                            @foreach ($user->roles as $role)
                                <h6 class="subtitle is-6">{{ $role->display_name }}</h6>
                            @endforeach
                            @else
                                <h5 class="subtitle is-6">User has no roles</h5>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
