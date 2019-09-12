@section('title', Auth::user()->name." ".Auth::user()->surname." Resources")

@extends('layouts.app')

@section('content')
    @include('_partials.nav.sidenav')
    <div id="safeguard">
        <div id="main">
            <div class="main-inner container py-5">
                @include('components.messages')
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold mb-3">Resource Library</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('resources.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card mt-2 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="#" method="post" class="d-inline">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6 form-group">
                                                    <select name="category" id="category" class="form-control form-control-sm text-capitalize">
                                                        <option value="all">All Media Items</option>
                                                        <option value="audio">audio</option>
                                                        <option value="video">videos</option>
                                                        <option value="document">documents</option>
                                                        <option value="image">images</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <select name="category" id="category" class="form-control form-control-sm text-capitalize">
                                                        <option value="all">All Dates</option>
                                                        <option value="audio">audio</option>
                                                        <option value="video">videos</option>
                                                        <option value="document">documents</option>
                                                        <option value="image">images</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="#" method="post">
                                            @csrf
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="resource_search" id="resource-search" placeholder="Search Library" class="form-control form-control-sm">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div>
                                <div class="table-responsive px-1">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="row">

                                                {{-- <th class="col-md-1">
                                                    <form class="d-flex justify-content-center">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="resourceAll" name="example1">
                                                            <label class="custom-control-label" for="resourceAll"></label>
                                                        </div>
                                                    </form>
                                                </th> --}}
                                                <th class="col-md-1"></th>
                                                <th class="col-md-6">File</th>
                                                <th class="col-md-1">Category</th>
                                                <th class="col-md-1">Size</th>
                                                <th class="col-md-2">Uploaded</th>
                                                <th class="col-md-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- audio --}}
                                            @include('components.media-list', ['type' => 'audio'])
                                            {{-- video --}}
                                            @include('components.media-list', ['type' => 'video'])
                                            {{-- documents --}}
                                            @include('components.media-list', ['type' => 'document'])
                                            {{-- assets --}}
                                            @include('components.media-list', ['type' => 'assets'])
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
