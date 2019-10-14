@section('title', "{$model->name} {$model->surname} Share")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="general">
        <div class="general-inner container py-5">
            <div class="row">
                <div class="col-md-6">
                    <a href='{{ route("{$name}.show", $model->uuid) }}' class="btn btn-sm btn-primary mb-4 text-capitalize"><i class="fas fa-chevron-left"></i> Go Back</a>
                    <h3 class="card-title font-weight-bold mb-3">Social Links</h3>
                    @if (count($model->social))
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Tag</th>
                                        <th>Social</th>
                                        <th>Share</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->social as $social)
                                        <tr>
                                            <td>{{ $social->social->name }}</td>
                                            <td>{{ $social->social->tag }}</td>
                                            <td><a href="{{ $social->page_link }}" target="_blank">{{ $social->page_link }}</a></td>
                                            <td><a href="{{ $social->share_link }}" target="_blank">{{ $social->share_link }}</a></td>
                                            <td>
                                                <form class="d-inline" action='{{ route("{$name}.social-media.destroy", [$model->uuid, $social->id]) }}' method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="lead">No social links found</p>
                    @endif
                </div>
                <div class="col-md-6">
                    @includeIf('components.messages')
                    @includeIf('components.errors')
                    <form action='{{ route("{$name}.social-media.store", $model->uuid) }}' method="POST">
                        @csrf
                        @includeIf('components.forms.social-media',['submitText' => 'Add Social'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
