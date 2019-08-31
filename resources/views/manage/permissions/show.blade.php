@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-15">
    <div class="columns">
        <div class="column">
            <h3 class="title">Permission Details</h3>
        </div>
        <div class="column">
            <a href="{{ route('permissions.edit', $permission->id )}}" class="button is-primary is-pulled-right">
                <i class="fas fa-user-edit m-r-5"></i> Edit Permission
            </a>
        </div>
    </div>
    <div class="columns">
        <div class="column is-two-thirds ">
            <div class="card">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <h5 class="title is-5">{{ $permission->display_name }}</h5>
                            <h6 class="subtitle is-6">{{ $permission->name }}</h6>
                            <p>
                                {{ $permission->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
