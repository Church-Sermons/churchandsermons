@extends('layouts.manage')

@section('content')
    <div class="custom-container m-t-10 m-l-20">
        <div class="columns">
            <div class="column">
                <h3 class="title">Manage Roles</h3>
            </div>
            <div class="column">
                <a href="{{ route('roles.create') }}" class="button is-primary is-pulled-right">
                    <i class="fas fa-user-plus m-r-5"></i> Create New Role
                </a>
            </div>
        </div>

        <div class="columns is-multiline">
            @foreach ($roles as $role)
            <div class="column is-one-quarter">
                    <div class="box">
                        <div class="media">
                            <div class="media-content">
                                <div class="content">
                                    <h4 class="title is-5">{{ $role->display_name }}</h4>
                                    <h5 class="is-subtitle is-6">{{ $role->name }}</h5>
                                    <p>{{ $role->description }}</p>
                                </div>
                                <div class="columns is-mobile">
                                    <div class="column is-one-half">
                                        <a href="{{ route('roles.show', $role->id)}}" class="button is-primary is-fullwidth">Details</a>
                                    </div>
                                    <div class="column is-one-half level-right">
                                        <div class="level-item">
                                            <a href="{{ route('roles.edit', $role->id) }}" class="button is-light is-fullwidth">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
    </div>
@endsection
