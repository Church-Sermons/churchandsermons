@section('title', 'Edit Member')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">{{ $organisation->name.__(" - Edit Member") }}</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            <form action="{{ route('organisations.team.update', [$organisation->uuid, $profile->id]) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="teamForm">
                                @csrf
                                @method('PUT')
                                @component('components.messages')@endcomponent
                                @component('organisations.team.form', ['categories' => $categories, 'oldCategory' => old('category', $profile->category_id)])
                                    @slot('name')
                                        {{ old('name', $profile->name) }}
                                    @endslot
                                    @slot('surname')
                                        {{ old('surname', $profile->surname) }}
                                    @endslot
                                    @slot('email')
                                        {{ old('email', $profile->email) }}
                                    @endslot
                                    @slot('website')
                                        {{ old('website', $profile->website) }}
                                    @endslot
                                    @slot('phone')
                                        {{ old('phone', $profile->phone) }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address', $profile->address) }}
                                    @endslot
                                    @slot('latitude')
                                        {{ old('latitude', $profile->lat) }}
                                    @endslot
                                    @slot('longitude')
                                        {{ old('longitude', $profile->lon) }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description', $profile->description) }}
                                    @endslot
                                    @slot('profile')
                                        {{ old('profile', $profile->profile_image) }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Update Member
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Category Modal Partial --}}
@include('categories.handler', ['parents' => ['profile'], 'selected' => 'profile'])
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // phone number add dashes
            const phone = document.getElementById('phone');


            // check value length on keyup
            phone.addEventListener('keyup', function(e){
                if(this.value.length >= 9){
                    const cleansedValue = this.value.replace(/\D[^\.]/g, "");
                    this.value = addDashes(cleansedValue, e);
                }

            });

            function addDashes(cv, e){
                // handling keys like del or backspace
                const key = e.which || e.keyCode || e.charCode;

                if(key != 8 && key != 46){
                    // create dashes
                    const firstPart = cv.slice(0,3);
                    const secondPart = cv.slice(3,6);
                    const thirdPart = cv.slice(6);

                    // return string combining all three parts
                    return `${firstPart}-${secondPart}-${thirdPart}`;
                }

                return;

            }



        });

    </script>
@endsection
