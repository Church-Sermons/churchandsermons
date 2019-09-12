@section('title', 'About Us')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <section id="banner">
            <div class="banner-content banner-about">
                <div class="dark-overlay py-5">
                    <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                        <h4 class="text-center display-4 text-uppercase font-weight-bold">
                            about us
                        </h4>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="bg-light">
            <div class="about-inner container py-5">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-capitalize font-weight-bold mb-2">about church & sermons</h1>
                        <p class="lead">
                            {!! $details->description !!}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="image-container-md shadow">
                            <img src="{{ asset('images/temp/slides/slide-1.jpg') }}" alt="about-us-description" class="w-100 h-100 img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mission">
            <div class="mission-inner container my-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="image-container-md shadow">
                            <img src="{{ asset('images/temp/slides/slide-2.jpg') }}" alt="about-us-description" class="w-100 h-100 img-thumbnail">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-capitalize font-weight-bold mb-2">our mission and vision</h1>
                        <p class="lead">
                            {!! $details->mission !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
