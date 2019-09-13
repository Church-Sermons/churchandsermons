@section('title', 'Add Slides')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <div id="slides">
            <div class="slides-inner container py-5">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @include('components.messages')
                        @include('components.errors')
                        {{-- display all existing slides --}}
                        <h3 class="card-title font-weight-bold mt-3">Upload Slides</h3>
                        <a href="{{ route('organisations.show', $organisation->uuid) }}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-chevron-left"></i> Back To Organisation</a>
                        <form action="{{ route('organisations.slides.store', $organisation->uuid) }}" method="post" class="mb-2 mt-1" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="slides[]" class="custom-file-input @error('slides') is-invalid @enderror" id="slides" multiple>
                                    <label for="slides" class="custom-file-label">Upload Slides</label>
                                    @error('slides')
                                        <p class="invalid-feedback">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                </div>
                            </div>
                        </form>
                        @if (count($organisation->getMedia('slides')))
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Uploaded</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organisation->getMedia('slides') as $slide)
                                            <tr>
                                                <td><img src="{{ $slide->getUrl() }}" alt="{{ $slide->name }}" height="50" width="50"></td>
                                                <td>{{ $slide->name }}</td>
                                                <td>{{ $slide->created_at?$slide->created_at->diffForHumans():null }}</td>
                                                <td>
                                                    <form action="{{ route('organisations.slides.delete', [$organisation->id, $slide->id]) }}" class="d-inline" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="lead">You currently have no slides</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
