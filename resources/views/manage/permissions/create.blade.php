@extends('layouts.manage')

@section('content')
<div class="custom-container m-t-15" id="user-form">
    <div class="columns">
        <div class="column is-two-thirds">
            <h3 class="title">Create Permission</h3>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <div class="block">
                    <b-radio native-value="basic" v-model="permissionType" name="permission_type">Basic Permission</b-radio>
                    <b-radio native-value="crud" v-model="permissionType" name="permission_type">CRUD Permission</b-radio>
                </div>
                <div v-if="permissionType == 'basic'">
                    <div class="field">
                        <label for="display_name" class="label">Name (Display Name)</label>
                        <div class="control ">
                            <input type="text" class="input" name="display_name">
                        </div>
                    </div>

                    <div class="field">
                        <label for="slug" class="label">Slug</label>
                        <div class="control">
                            <input type="text" class="input" name="name">
                        </div>
                    </div>

                    <div class="field">
                        <label for="description" class="label">Description</label>
                        <div class="control">
                            <input type="text" class="input" name="description" id="description">
                        </div>
                    </div>
                </div>

                <div v-if="permissionType == 'crud'">
                    <div class="columns">
                        <div class="column is-fullwidth">
                            <div class="field">
                                <label for="resource" class="label">Resource</label>
                                <div class="control">
                                    <input type="text" class="input" name="resource" id="resource" v-model="resource">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-one-quarter">
                            <div class="field">
                                <b-checkbox native-value="create" v-model="crudSelected">Create</b-checkbox>
                            </div>
                            <div class="field">
                                <b-checkbox native-value="read" v-model="crudSelected">Read</b-checkbox>
                            </div>
                            <div class="field">
                                <b-checkbox native-value="update" v-model="crudSelected">Update</b-checkbox>
                            </div>
                            <div class="field">
                                <b-checkbox native-value="delete" v-model="crudSelected">Delete</b-checkbox>
                            </div>
                        </div>
                        <input type="hidden" name="crud_selected" :value="crudSelected">
                        <div class="column is-three-quarters">
                            <div class="card">
                                <div class="card-content">
                                    <table class="table is-striped is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="resource.length >= 3">
                                            <tr v-for="item in crudSelected">
                                                <td v-text="crudName(item)"></td>
                                                <td v-text="crudSlug(item)"></td>
                                                <td v-text="crudDescription(item)"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="field m-t-10">
                    <div class="control">
                        <button class="button is-primary is-outlined">Create Permission</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const app = new Vue({
        el:'#app',
        data:{
            permissionType: "basic",
            resource: "",
            crudSelected: ["create", "read", "update", "delete"],
        },
        methods:{
            crudName: function(item) {
            return `${item.substr(0, 1).toUpperCase()}${item.substr(
                1
            )} ${app.resource.substr(0, 1).toUpperCase()}${app.resource.substr(
                1
            )}`;
            },
            crudSlug: function(item) {
                return `${item.toLowerCase()}-${app.resource.toLowerCase()}`;
            },
            crudDescription: function(item) {
                return `Allows a user to ${item.toUpperCase()} ${app.resource
                    .substr(0, 1)
                    .toUpperCase()}${app.resource.substr(1)}`;
            }
        }
    })
</script>
@endsection
