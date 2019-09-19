@section('title', 'Home')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <section id="custom-banner" class="home-banner">
        <div class="custom-banner-inner overlay-secondary">
            <div class="container py-5 text-light">
                <h1 class="text-center text-capitalize display-5">what are you looking for?</h1>
                <div class="icons-display py-3">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ route('organisations.index') }}" class="main-link">
                                <img src="{{ asset('images/app/icons/church.jpg') }}" alt="organisation-logo" height="150" class="rounded w-100"/>
                                <h6 class="text-uppercase text-center mt-1">organisations</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ route('sermons.index') }}" class="main-link">
                                <img src="{{ asset('images/app/icons/sermon.jpg') }}" alt="sermon-logo" height="150" class="rounded  w-100"/>
                                <h6 class="text-uppercase text-center mt-1">sermons</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ route('profiles.index') }}" class="main-link">
                                <img src="{{ asset('images/app/icons/profile.jpg') }}" alt="profile-logo" height="150" class="rounded  w-100"/>
                                <h6 class="text-uppercase text-center mt-1">profiles</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="#" class="main-link">
                                <img src="{{ asset('images/app/icons/resource.jpg') }}" alt="resource-logo" height="150" class="rounded w-100"/>
                                <h6 class="text-uppercase text-center mt-1">resources</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="intro">
        <div class="intro-inner container py-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between flex-column text-center h-100 align-items-center">
                        <h4><i class="far fa-plus-square fa-5x"></i></h4>
                        <p>
                            Placing items into categories helps you find what you want easily and efficiently and also enables people find an item you created easily. Add your own category and
                            place items you create into your custom categories.
                        </p>
                        <a href="{{ route('categories.create') }}" class="btn btn-custom mb-2">Add Category</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between flex-column text-center h-100 align-items-center">
                        <h4><i class="fas fa-user-circle fa-5x"></i></h4>
                        <p>
                            Make it easy for your organization to be found and reach out
                            to those around you by registering your organization.
                        </p>
                        <a href="{{ route('categories.create') }}" class="btn btn-custom">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ORGANISATIONS --}}
    <section id="organisation" class="bg-light">
        <div class="organisation-inner container py-5">
            <h2 class="text-uppercase font-weight-bold text-center">organisation categories</h2>
            <p class="text-center">
                The different churches or religious institutions are put into
                different categories to ease your search and help you find exactly
                what you are looking for.
            </p>
            <div class="icons-display">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($categories->where('linked_to', 'organisation') as $category)
                        @if ($loop->iteration < 5)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ route('organisations.index') }}" class="main-link d-flex flex-column align-items-center">
                                    <span class="holder d-flex justify-content-center align-items-center rounded-circle">
                                        <span class="text-uppercase text-light">{{ substr($category->name, 0, 1) }}</span>
                                    </span>
                                    <h6 class="text-uppercase text-center mt-2 font-weight-bold text-dark">{{ $category->name }}</h6>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- SERMONS --}}
    <section id="sermon">
        <div class="sermon-inner container py-5">
            <h2 class="text-uppercase font-weight-bold text-center">sermon categories</h2>
            <p class="text-center">
                Browse our sermon directory by format with the possibility of
				downloading some.
            </p>
            <div class="icons-display">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($categories->where('linked_to', 'resource') as $category)
                        @if ($loop->iteration < 5)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ route('sermons.index') }}" class="main-link d-flex flex-column align-items-center">
                                    <span class="holder d-flex justify-content-center align-items-center rounded-circle">
                                        <span class="text-uppercase text-light">{{ substr($category->name, 0, 1) }}</span>
                                    </span>
                                    <h6 class="text-uppercase text-center mt-2 font-weight-bold text-dark">{{ $category->name }}</h6>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- PROFILES --}}
    <section id="profile" class="bg-light">
        <div class="profile-inner container py-5">
            <h2 class="text-uppercase font-weight-bold text-center">profile categories</h2>
            <p class="text-center">
                Looking for a preacher, speaker, mentor, musician or public figures
                near you? We put them into categories to help you easily find what
                you are looking for.
            </p>
            <div class="icons-display">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($categories->where('linked_to', 'profile') as $category)
                        @if ($loop->iteration < 5)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="{{ route('profiles.index') }}" class="main-link d-flex flex-column align-items-center">
                                    <span class="holder d-flex justify-content-center align-items-center rounded-circle">
                                        <span class="text-uppercase text-light">{{ substr($category->name, 0, 1) }}</span>
                                    </span>
                                    <h6 class="text-uppercase text-center mt-2 font-weight-bold text-dark">{{ $category->name }}</h6>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- RESOURCES --}}
    <section id="resource">
        <div class="resource-inner container py-5">
            <h2 class="text-uppercase font-weight-bold text-center">resource categories</h2>
            <p class="text-center">
                We make it easy for you to find different resources to help you grow
				in every aspect of life.
            </p>
            <div class="icons-display">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($categories->where('linked_to', 'resource') as $category)
                        @if ($loop->iteration < 5)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <a href="#" class="main-link d-flex flex-column align-items-center">
                                    <span class="holder d-flex justify-content-center align-items-center rounded-circle">
                                        <span class="text-uppercase text-light">{{ substr($category->name, 0, 1) }}</span>
                                    </span>
                                    <h6 class="text-uppercase text-center mt-2 font-weight-bold text-dark">{{ $category->name }}</h6>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

