@section('title', 'About Us')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <section id="custom-banner" class="banner-about">
            <div class="custom-banner-inner overlay-secondary">
                <div class="container py-5 text-light">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 py-5">
                            <h1 class="text-center text-uppercase font-weight-bold">
                                about us
                            </h1>
                        </div>
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
                    <div class="col-md-6 order-sm-2 order-xs-2">
                        <div class="image-container-md shadow">
                            <img src="{{ asset('images/temp/slides/slide-2.jpg') }}" alt="about-us-description" class="w-100 h-100 img-thumbnail">
                        </div>
                    </div>
                    <div class="col-md-6 order-sm-1 order-xs-1">
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
