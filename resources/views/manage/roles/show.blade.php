@extends('layouts.manage')

@section('content')
    <div class="custom-container m-t-10 m-l-20">
        <div class="columns">
            <div class="column is-two-thirds">
                <h3 class="title">{{ $role->display_name }}<small class="m-l-5">({{ $role->name }})</small></h3>
                <h5 class="subtitle is-6 m-t-5 m-b-5">{{ $role->description }}</h5>
            </div>
            <div class="column is-one-third">
                <a href="{{ route('roles.edit', $role->id) }}" class="button is-primary is-pulled-right">
                    <i class="fas fa-edit m-r-5"></i> Edit Role
                </a>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="box">
                    <div class="media">
                        <div class="media-content">
                            <div class="content">
                                <h4 class="title is-4">Permissions:</h4>
                                @foreach ($role->permissions as $permission)
                                    <h5 class="title is-5">{{ $permission->display_name }}<small class="subtitle m-l-5"><i>({{ $permission->name }})</i></small></h5>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
