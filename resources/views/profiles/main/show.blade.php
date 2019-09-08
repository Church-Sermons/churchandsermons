@section('title', "{$profile->name} {$profile->surname}")

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <section id="banner">
        <div class="banner-content">
            <div class="dark-overlay py-5">
                <div class="container d-flex justify-content-center w-100 h-100 align-items-center flex-column">
                    <h4 class="text-center display-4 text-uppercase font-weight-bold">
                        profile details
                    </h4>
                    @isTribrid($profile)
                        <a href="{{ route('profiles.edit', $profile->uuid) }}" class="btn btn-primary btn-lg text-uppercase">
                            <i class="fas fa-edit"></i> edit profile
                        </a>
                    @endisTribrid
                </div>
            </div>
        </div>
    </section>

    <div id="self">
        <div class="self-inner container py-5">
            @include('components.messages')
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-capitalize font-weight-bold mb-2">{{ "{$profile->name} {$profile->surname}" }}</h1>
                    <h5 class="text-primary text-capitalize mb-1">{{ $profile->category->name }}</h5>
                    <span class="d-block border-primary mb-3 mini-line"></span>
                    <p class="lead">{{ $profile->description }}</p>
                    <h5 class="text-capitalize font-weight-bold">Social Links</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mt-1">
                                <span class="social-container rounded-circle d-flex justify-content-center align-items-center">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                </span>
                                <span class="social-container rounded-circle d-flex justify-content-center align-items-center">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </span>
                                <span class="social-container rounded-circle d-flex justify-content-center align-items-center">
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </span>
                                <span class="social-container rounded-circle d-flex justify-content-center align-items-center">
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-capitalize font-weight-bold mt-3">Rating</h5>
                    <p class="lead">
                        @foreach (Helper::starRating($profile->average_review) as $review)
                            <i class="text-primary {{ $review }}"></i>
                        @endforeach
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="image-container-md shadow-lg">
                        <img src='{{ asset("storage/{$profile->profile_image}") }}' alt='{{ "{$profile->name}-{$profile->surname}-avatar" }}' class="w-100 h-100 img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="work" class="bg-light">
        <div class="work-inner container py-5">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-capitalize font-weight-bold mb-4">skills</h3>
                    <div>
                        <div class="progress">
                            <div class="progress-bar w-50">50%</div>
                        </div>
                        <p class="small text-uppercase mt-1"><i class="fab fa-html5"></i> html</p>
                    </div>
                    <div>
                        <div class="progress">
                            <div class="progress-bar w-25">25%</div>
                        </div>
                        <p class="small text-uppercase mt-1"><i class="fab fa-css3-alt"></i> css</p>
                    </div>
                    <div>
                        <div class="progress">
                            <div class="progress-bar w-75">75%</div>
                        </div>
                        <p class="small text-uppercase mt-1"><i class="fab fa-php"></i> php</p>
                    </div>
                    <div>
                        <div class="progress">
                            <div class="progress-bar w-100">100%</div>
                        </div>
                        <p class="small text-uppercase mt-1"><i class="fab fa-js"></i> javascript</p>
                    </div>
                    <div>
                        <div class="progress">
                            <div class="progress-bar w-50">50%</div>
                        </div>
                        <p class="small text-uppercase mt-1"><i class="fab fa-python"></i> python</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-capitalize font-weight-bold mb-2">specialties</h3>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio soluta ratione pariatur atque cumque quidem?</p>
                    <ul class="list-group">
                        <li class="list-group-item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
                        <li class="list-group-item">Deleniti molestias maiores veniam numquam explicabo. </li>
                        <li class="list-group-item">Asperiores aliquam explicabo exercitationem magnam est dicta?</li>
                        <li class="list-group-item">Optio, laudantium nostrum. Possimus voluptas ipsum incidunt.</li>
                        <li class="list-group-item">Aperiam perspiciatis harum vitae itaque, autem velit nobis.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="contact">
        <div class="contact-inner container py-5">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-capitalize font-weight-bold mb-4">send private message</h3>
                    <form action="{{ route('profiles.contacts.store', $profile->uuid)}}" method="POST">
                        @csrf
                        @component('contacts.form')
                            @slot('name')
                                {{ old('name') }}
                            @endslot
                            @slot('email')
                                {{ old('email') }}
                            @endslot
                            @slot('subject')
                                {{ old('subject') }}
                            @endslot
                            @slot('message')
                                {{ old('message') }}
                            @endslot
                            @slot('submitButtonText')
                                Send Message
                            @endslot
                        @endcomponent
                    </form>
                </div>
                <div class="col-md-6">
                    <h3 class="text-capitalize font-weight-bold mb-4">contact information</h3>
                    <p class="lead">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus eos ipsa ratione sed sit hic!
                    </p>
                    <p><a href="{{ $profile->website }}" target="_blank"><i class="fas fa-globe mr-2 text-primary"></i>{{ $profile->website }}</a></p>
                    <p><i class="fas fa-phone mr-2 text-primary"></i>{{ $profile->phone }}</p>
                    <p><i class="fas fa-envelope mr-2 text-primary"></i>{{ $profile->email }}</p>
                    <p><i class="fas fa-map-marker-alt mr-2 text-primary"></i>{{ $profile->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

