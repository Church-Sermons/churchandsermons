@section('title', __("Tell ").$organisation->name)

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Tell Us. Please</h2>
                            <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p>
                            <form action="{{ route('organisations.claims.store', $organisation->uuid) }}" method="post" class="py-2">
                                @csrf
                                @component('components.messages')@endcomponent
                                @component('claims.form')
                                    @slot('subject')
                                        {{ old('subject') }}
                                    @endslot
                                    @slot('message')
                                        {{ old('message') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Send Claim
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
