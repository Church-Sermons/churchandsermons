@extends('layouts.manage')

@section('content')
    <div class="custom-container m-t-10 m-l-20">
        <div class="columns">
            <div class="column">
                <h3 class="title">Create Role</h3>
            </div>
        </div>
        <form action="{{ route('roles.store')}}" method="POST">
            @csrf
            <div class="columns">
                <div class="column">
                    <div class="box">
                        <div class="media">
                            <div class="media-content">
                                <div class="content">
                                    <div class="field">
                                        <label for="display_name" class="label">Name (Display Name)</label>
                                        <div class="control">
                                            <input type="text" name="display_name" class="input">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label for="display_name" class="label">Slug</label>
                                        <div class="control">
                                            <input type="text" name="name" class="input">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label for="display_name" class="label">Description</label>
                                        <div class="control">
                                            <input type="text" name="description" class="input">
                                        </div>
                                    </div>

                                    {{-- Roles from Vue --}}
                                    <input type="hidden" name="permissions" :value="permissionsSelected">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="box">
                        <div class="media">
                            <div class="media-content">
                                <div class="content">
                                    <h4 class="title is-4">Permissions:</h4>
                                    <div>
                                        @foreach ($permissions as $permission)
                                        <div class="field" >
                                            <b-checkbox v-model="permissionsSelected" native-value="{{ $permission->id }}"> {{ $permission->display_name }} <em>({{ $permission->description }})</em></b-checkbox>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="columns">
                                        <div class="column is-one-third">
                                            <div class="field">
                                                <div class="control">
                                                    <button class="button is-primary is-outlined m-t-20 is-fullwidth">Create Role</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        permissionsSelected: []
    }
})
</script>
@endsection
