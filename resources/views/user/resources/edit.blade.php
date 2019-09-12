"@section('title',"Edit Resource For ".Auth::user()->name." ".Auth::user()->surname)

@extends('layouts.app')

@section('content')
@include('_partials.nav.sidenav')
<div id="safeguard">
    <div id="main">
        <div class="container main-inner py-5">
            <form action="{{ route('resources.update', $resource->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            @if (strpos($resource->collection_name,'audio') !== false)
                                <div class="text-center">
                                    <i class="far fa-file-audio fa-10x"></i>
                                </div>
                            @elseif(strpos($resource->collection_name, 'video') !== false)
                                <div class="text-center">
                                    <i class="far fa-file-video"></i>
                                </div>
                            @elseif(strpos($resource->collection_name, 'document') !== false)
                                <div class="text-center">
                                    <i class="far fa-file-alt"></i>
                                </div>
                            @else
                                <img src="{{ $resource->getUrl() }}" alt="{{ $resource->name }}-image" class="w-100 h-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>File Name</th>
                                            <td>{{ $resource->file_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>File Type</th>
                                            <td>{{ $resource->mime_type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Uploaded</th>
                                            <td>{{ $resource->created_at?$resource->created_at->diffForHumans():null }}</td>
                                        </tr>
                                        <tr>
                                            <th>File Size</th>
                                            <td>{{ $resource->human_readable_size }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @component('resources.form', ['categories' => $categories, 'oldCategory' => old('category', $resource->getCustomProperty('category'))])
                                    @slot('name')
                                        {{ old('name', $resource->name) }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description', $resource->getCustomProperty('description')) }}
                                    @endslot
                                    @slot('file')
                                        {{ old('file_name', $resource->file_name) }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Edit Resource
                                    @endslot
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Category Modal Partial --}}
@include('categories.handler', ['parents' => ['resource'], 'selected' => 'resource'])
@endsection
@section('scripts')
    <script>
        // Form Persistence
        const resourcesForm = document.getElementById('resourcesForm');
        FormPersistence.persist(resourcesForm, {
            useSessionStorage: true
        });
    </script>
@endsection
