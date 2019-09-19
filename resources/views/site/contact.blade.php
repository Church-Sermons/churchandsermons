@section('title', 'Contact Us')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <section id="custom-banner" class="banner-contact">
            <div class="custom-banner-inner overlay-secondary">
                <div class="container py-5 text-light">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 py-5">
                            <h1 class="text-center text-uppercase font-weight-bold">
                                Contact Us
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="bg-light">
            <div class="about-inner container py-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2 bg-white py-4 px-2">
                            <div class="inner-card d-flex">
                                <div class="left d-flex justify-content-center align-items-center col-2">
                                    <span class="text-center icon-handler rounded-circle">
                                        <i class="fas fa-phone-alt text-custom-primary"></i>
                                    </span>
                                </div>
                                <div class="right d-flex justify-content-center flex-column col-10">
                                    <span class="font-weight-bold text-capitalize">phone number</span>
                                    <span class="text-muted mini-texts">+(90) 0543 123 4567</span>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2 bg-white py-4 px-2">
                            <div class="inner-card d-flex">
                                <div class="left d-flex justify-content-center align-items-center col-2">
                                    <span class="text-center icon-handler rounded-circle">
                                        <i class="fas fa-envelope text-custom-primary"></i>
                                    </span>
                                </div>
                                <div class="right d-flex justify-content-center flex-column col-10">
                                    <span class="font-weight-bold text-capitalize">Email Address</span>
                                    <span class="text-muted mini-texts">info@churchandsermons.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2 bg-white py-4 px-2">
                            <div class="inner-card d-flex">
                                <div class="left d-flex justify-content-center align-items-center col-2">
                                    <span class="text-center icon-handler rounded-circle">
                                        <i class="fas fa-map-marker-alt text-custom-primary"></i>
                                    </span>
                                </div>
                                <div class="right d-flex justify-content-center flex-column col-10">
                                    <span class="font-weight-bold text-capitalize">Address</span>
                                    <span class="text-muted mini-texts">349 Boyd Knolls East Demarcus, RI 13939-1050</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title font-weight-bold mb-3 text-center">Get In Touch</h2>
                                <p class="card-text text-center">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptatem non, quasi aliquid corporis atque, asperiores
                                    fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                    ut facere. Minus, expedita ut. Odit?
                                </p>
                                <form action="{{ route('contact.messages.store') }}" method="post" class="py-2">
                                    @csrf
                                    @include('components.messages')
                                    @component('components.forms.contacts')
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
