@extends('layouts.manage')

@section('content')
    <div class="custom-container m-t-10 m-l-20">
        <div class="columns">
            <div class="column">
                <h3 class="title">Create Post</h3>
            </div>
        </div>
        <div class="columns">
            <div class="column is-two-thirds">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <b-field label="Name">
                            <b-input v-model="name"></b-input>
                        </b-field>
                        <p>
                            <i class="fas fa-link m-r-5"></i> {{ url('/blog')}}
                        </p>
                    </div>
                    <div class="field">
                        <b-field label="Message">
                            <b-input maxlength="200" type="textarea" placeholder="Tell Your Story..."></b-input>
                        </b-field>
                    </div>
                </form>
            </div>
            <div class="column is-one-third">
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48by48">
                                    <img src="https://via.placeholder.com/50/50" alt="author-image" class="is-rounded">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-6">Margai Wangara</p>
                                <p class="subtitle is-6">@margaiwangara</p>
                            </div>
                        </div>
                        <div class="field">
                            <small class="has-text-grey-light">
                                <i class="fas fa-newspaper m-r-5"></i> <i>Draft Saved A Few Minutes Ago</i>
                            </small>
                        </div>

                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <button class="button is-info is-outlined is-fullwidth">
                                        Save Draft
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="button is-primary is-fullwidth">
                                        Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    const app = new Vue({
        el:'#app',
        data:{

        }
    });
</script>
@endsection
