@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-15" id="user-form">
    <div class="columns">
        <div class="c   olumn is-two-thirds">
            <h3 class="title">Create User</h3>
        </div>
    </div>
    <form action="{{ route('users.store') }}" method="POST">
    <div class="columns">
        <div class="column is-half">
            @csrf
            <div class="field">
                <label for="name" class="label">Name</label>
                <div class="control ">
                    <input type="text" class="input" name="name">
                </div>
            </div>

            <div class="field">
                <label for="email" class="label">Email</label>
                <div class="control">
                    <input type="email" class="input" name="email">
                </div>
            </div>

            <div class="field">
                <label for="password" class="label">Password</label>
                <div class="control">
                    <input type="text" class="input" name="password" id="password" v-if="!auto_password">
                    <b-checkbox v-model="auto_password" name="auto_generate" class="m-t-15">AutoGenerate Password</b-checkbox>
                </div>
            </div>
        </div>
        <div class="column is-half">
            <div class="field">
                <label for="roles" class="label">Roles</label>
                <input type="hidden" name="roles" :value="rolesSelected">
            </div>
            <div class="control">
                @foreach ($roles as $role)
                    <div class="field">
                        <b-checkbox v-model="rolesSelected" native-value="{{ $role->id }}">{{ $role->display_name }}</b-checkbox>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column is-one-quarter is-offset-three-quarters">
            <div class="field">
                <div class="control">
                    <button class="button is-primary is-outlined is-fullwidth">Create User</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
const app = new Vue({
    el: '#app',
    data:{
        auto_password: true,
        rolesSelected:[]
    }
})
</script>
@endsection
