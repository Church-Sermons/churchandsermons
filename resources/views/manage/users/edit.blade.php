@extends('layouts.manage')

@section('content')
<div class="users-container m-t-15">
    <div class="columns">
        <div class="column is-two-thirds">
            <h3 class="title">Edit User</h3>
        </div>
    </div>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="columns">
            <div class="column">
                <div class="columns">
                    <div class="column is-half">
                        <div class="field">
                            <label for="name" class="label">Name</label>
                            <div class="control ">
                                <input type="text" class="input" name="name" value={{ $user->name }}>
                            </div>
                        </div>

                        <div class="field">
                            <label for="email" class="label">Email</label>
                            <div class="control">
                                <input type="email" class="input" name="email" value={{ $user->email }}>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password" class="label">Password</label>
                            <div>
                                <div class="field">
                                    <b-radio native-value="keep" v-model="password_options" name="password_options">Keep Existing Password</b-radio>
                                </div>
                                <div class="field">
                                    <b-radio v-model="password_options" native-value="auto" name="password_options">AutoGenerate Password</b-radio>
                                </div>
                                <div class="field">
                                    <b-radio v-model="password_options" native-value="manual" name="password_options">Manually Input Password</b-radio>
                                    <div class="control">
                                        <input type="text" class="input m-t-10" name="password" id="password_id" v-if="password_options == 'manual'">
                                    </div>
                                </div>
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

            </div>
        </div>
        <hr/>
        <div class="columns">

            <div class="column is-one-quarter is-offset-three-quarters">
                <div class="field">
                    <div class="control">
                        <button class="button is-primary is-outlined is-fullwidth">Edit User</button>
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
        el:'#app',
        data:{
            password_options: "keep",
            rolesSelected: {!! $user->roles->pluck('id') !!}
        }
    })
</script>
@endsection
