@section('title', 'Home')

@extends('layouts.app')

@section('content')
<section id="banner">
    <div class="banner-content banner-home">
        <div class="dark-overlay overlay-home py-5">
            <div class="container">
                <h4 class="text-center display-4 text-capitalize">
                what are you looking for?
                </h4>
                <div class="row py-5">
                <div class="col-md-6 offset-md-3">
                    <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <span
                        class="icon-container d-flex justify-content-center pt-2 w-100 text-center rounded bg-light px-2"
                        >
                        <a href="{{ route('organisations.index') }}" class="text-docoration-none">
                            <i class="fas fa-place-of-worship fa-5x"></i>
                            {{-- <img src="{{ asset('images/icons/church.svg') }}" alt="organisation-icon" class="w-100 h-100"> --}}
                            <h5 class="display-5 text-uppercase small pt-2">
                            organisations
                            </h5>
                        </a>
                        </span>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <span
                        class="icon-container w-100 d-flex justify-content-center text-center pt-2 rounded bg-light px-2"
                        >
                        <a href="{{ route('sermons.index') }}" class="text-docoration-none">
                            <i class="fas fa-bible fa-5x"></i>
                            {{-- <img src="{{ asset('images/icons/bible.svg') }}" alt="sermon-icon" class="w-100 h-100"> --}}
                            <h5 class="display-5 text-uppercase small pt-2">
                            sermons
                            </h5>
                        </a>
                        </span>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <span
                        class="icon-container d-flex justify-content-center pt-2 w-100 text-center rounded bg-light px-2"
                        >
                        <a href="{{ route('profiles.index') }}" class="text-docoration-none">
                            <i class="fas fa-user fa-5x"></i>
                            {{-- <img src="{{ asset('images/icons/avatar.svg') }}" alt="profile-icon" class="w-100 h-100"> --}}
                            <h5 class="display-5 text-uppercase small pt-2">
                            profiles
                            </h5>
                        </a>
                        </span>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <span
                        class="icon-container d-flex justify-content-center pt-2 w-100 text-center rounded bg-light px-2"
                        >
                        <a href="#">
                            <i class="fas fa-book-open fa-5x"></i>
                            {{-- <img src="{{ asset('images/icons/open-book.svg') }}" alt="resource-icon" class="w-100 h-100"> --}}
                            <h5 class="display-5 text-uppercase small pt-2">
                            resources
                            </h5>
                        </a>
                        </span>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End of banner section -->

<section id="actions" class="bg-light">
    <div class="container py-5">
        <div class="row">
        <div class="col-md-6 col-sm-12 text-center px-2">
            <div class="row">
            <div class="col">
                <i class="far fa-file-alt fa-3x"></i>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <p class="py-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Molestias sequi ea omnis cum ducimus mollitia, consequuntur
                modi temporibus fugiat maxime.
                </p>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <a href="#" class="btn btn-outline-primary">Write A Review</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 text-center px-2">
            <div class="row">
            <div class="col">
                <i class="fas fa-user-plus fa-3x"></i>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <p class="py-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Molestias sequi ea omnis cum ducimus mollitia, consequuntur
                modi temporibus fugiat maxime.
                </p>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <a href="{{ route('organisations.create' )}}" class="btn btn-outline-primary">Register</a>
            </div>
            </div>
        </div>
        </div>
    </div>
</section><!-- End of actions section -->

<section id="organisations">
    <div class="container text-center py-5">
        <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
            <div class="col">
                <h4 class="display-5 text-uppercase font-weight-bold">
                organisation categories
                </h4>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <p class="py-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quod dolorum ab eum corrupti nulla in repellat iste,
                officiis qui mollitia nemo incidunt deserunt ut cumque nisi
                natus, ratione labore veritatis.
                </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="row">
                <div class="col-md-4">
                    <span
                    class="d-flex justify-content-center pt-2 w-100 text-center"
                    >
                    <a href="#">
                        <i class="fas fa-church fa-5x"></i>
                        <h5 class="display-5 text-uppercase small pt-2">
                        church
                        </h5>
                    </a>
                    </span>
                </div>
                <div class="col-md-4">
                    <span
                    class="d-flex justify-content-center pt-2 w-100 text-center"
                    >
                    <a href="#">
                        <i class="fas fa-dove fa-5x"></i>
                        <h5 class="display-5 text-uppercase small pt-2">
                        charity
                        </h5>
                    </a>
                    </span>
                </div>
                <div class="col-md-4">
                    <span
                    class="d-flex justify-content-center pt-2 w-100 text-center"
                    >
                    <a href="#">
                        <i class="fas fa-hand-holding-heart fa-5x"></i>
                        <h5 class="display-5 text-uppercase small pt-2">
                        ngo
                        </h5>
                    </a>
                    </span>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section><!-- End of organisations -->

<section id="sermons" class="bg-light">
    <div class="container text-center py-5">
        <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
            <div class="col">
                <h4 class="display-5 text-uppercase font-weight-bold">
                sermons categories
                </h4>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <p class="py-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quod dolorum ab eum corrupti nulla in repellat iste,
                officiis qui mollitia nemo incidunt deserunt ut cumque nisi
                natus, ratione labore veritatis.
                </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="row">
                <div class="col-md-4">
                    <span
                    class="d-flex justify-content-center pt-2 w-100 text-center"
                    >
                    <a href="#">
                        <i class="fas fa-file-video fa-5x"></i>
                        <h5 class="display-5 text-uppercase small pt-2">audio</h5>
                    </a>
                    </span>
                </div>
                <div class="col-md-4">
                    <span
                    class="d-flex justify-content-center pt-2 w-100 text-center"
                    >
                    <a href="#">
                        <i class="fas fa-file-audio fa-5x"></i>
                        <h5 class="display-5 text-uppercase small pt-2">videos</h5>
                    </a>
                    </span>
                </div>
                <div class="col-md-4">
                    <span
                    class="d-flex justify-content-center pt-2 w-100 text-center"
                    >
                    <a href="#">
                        <i class="fas fa-file-alt fa-5x"></i>
                        <h5 class="display-5 text-uppercase small pt-2">documents</h5>
                    </a>
                    </span>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section><!-- End of sermons -->

<section id="recents">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <h4 class="display-5 text-uppercase text-center py-3 font-weight-bold">
                    recently added
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="recentsCarousel"class="carousel slide" data-ride="carousel">
                    <!-- indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#recentsCarousel"data-slide-to="0"class="active"></li>
                        <li data-target="#recentsCarousel" data-slide-to="1"></li>
                        <li data-target="#recentsCarousel" data-slide-to="2"></li>
                        <li data-target="#recentsCarousel" data-slide-to="3"></li>
                    </ul>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="card">
                                    <img
                                    src="{{ asset('images/temp/slides/slide-1.jpg') }}"
                                    alt="carousel-card-1"
                                    class="card-img-top"
                                    />
                                    <div class="card-body">
                                        <h4 class="card-title">Lorem, Ipsum.</h4>
                                        <p class="card-text">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit. Error, optio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="card">
                                    <img src="{{ asset('images/temp/slides/slide-2.jpg') }}" alt="carousel-card-1" class="card-img-top"/>
                                    <div class="card-body">
                                        <h4 class="card-title">Lorem, Ipsum.</h4>
                                        <p class="card-text">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit. Error, optio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img src="{{ asset('images/temp/slides/slide-3.jpg') }}" alt="carousel-card-1" class="card-img-top"/>
                                <div class="card-body">
                                    <h4 class="card-title">Lorem, Ipsum.</h4>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipisicing elit. Error, optio?
                                    </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-1.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top w-100 h-100"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-1.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-2.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-3.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-1.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-1.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-2.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-3.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="card">
                                <img
                                src="{{ asset('images/temp/slides/slide-1.jpg') }}"
                                alt="carousel-card-1"
                                class="card-img-top"
                                />
                                <div class="card-body">
                                <h4 class="card-title">Lorem, Ipsum.</h4>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Error, optio?
                                </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <!-- Left and right controls -->
                 <a
                    class="carousel-control-prev"
                    href="#recentsCarousel"
                    data-slide="prev"
                >
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a
                    class="carousel-control-next"
                    href="#recentsCarousel"
                    data-slide="next"
                >
                    <span class="carousel-control-next-icon"></span>
                </a>
                </div>
            </div>
        </div>
    </div>
</section><!-- End of Recents Section -->
@endsection

{{-- @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif --}}
