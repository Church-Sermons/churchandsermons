@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-third is-offset-one-third">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title"></h4>
                    </div>
                    <div class="card-content">
                        <h5 >{{ $contact->name }}</h5>
                        <h5>{{ $contact->email }}</h5>
                        <h5>{{ $contact->subject }}</h5>
                        <p>{{ $contact->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
