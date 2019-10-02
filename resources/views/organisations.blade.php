@section('title', 'Organisations')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <section id="header" class="bg-light">
            <div class="header-inner container-fluid py-2">
                <h2 class="font-weight-bold text-uppercase mb-0 mt-2">schaden plc</h2>
                <h5 class="font-weight-bold text-uppercase mb-2">church</h5>
            </div>
        </section>

        <section id="details">
            <div class="container py-2">
                <div class="row">
                    <div class="col-md-3">
                        <div class="left bg-light border py-2">
                            {{-- Image Logo --}}
                            <div class="logo-holder d-flex justify-content-center align-items center">
                                <img src="{{ asset('images/app/publicFigure.png')}}" alt="org-logo" height="170" width="170" class="rounded-circle">
                            </div>
                            <div class="px-2">
                                {{-- Contact Info --}}
                                <h4 class="card-title text-uppercase h5 font-weight-bold">contact information</h4>
                                <h6 class="h6 font-weight-bold">Location</h6>
                                <p class="lead mini-texts">60832 Brenda Glens Apt. 370 West Lurline, CT 74118-4691</p>
                                {{-- Map Div --}}
                                {{-- <div id="map" class="my-3" data-latitude="{{ $organisation->lat }}" data-longitude="{{ $organisation->lon }}"></div> --}}

                                <h6 class="h6 font-weight-bold mt-0">Phone</h6>
                                <p class="lead mini-texts">256-854-7859</p>
                                <h6 class="h6 font-weight-bold">Email</h6>
                                <p class="lead mini-texts">kmckenzie@lehner.net</p>
                                <div class="clearfix">
                                    <span class="float-left">
                                        <h6 class="h6 font-weight-bold">Website</h6>
                                    </span>
                                    <span class="float-right">
                                        <a href="#">
                                            <i class="fas fa-edit" title="Edit Website"></i>
                                        </a>
                                    </span>
                                </div>
                                <p class="lead mini-texts">
                                    <a href="#">http://baptist.com/</a>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="right bg-light border">
                            right side
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>
@endsection
