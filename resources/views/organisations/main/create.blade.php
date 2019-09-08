@section('title', 'Create Organisation')

@extends('layouts.app')

@section('content')

<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Create Organisation</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            @include('components.errors')
                            <form action="{{ route('organisations.store') }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="organisationForm">
                                @csrf

                                @component('organisations.main.form', [
                                            'categories' => $categories, 'oldCategory' => old('category'),
                                            'weekDays' => array_values(Config::get('site_variables.days')),
                                            'dayTimes' => generateHours(),'timeSelected' => old('time_open'),
                                            'daySelected' => old('day_of_week'), 'durationSelected' => old('work_duration'),
                                            'sites' => $sites, 'socialId' => old('social_id')])
                                     @slot('name')
                                        {{ old('name') }}
                                    @endslot
                                    @slot('email')
                                        {{ old('email') }}
                                    @endslot
                                    @slot('website')
                                        {{ old('website') }}
                                    @endslot
                                    @slot('phone')
                                        {{ old('phone') }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address') }}
                                    @endslot
                                    @slot('latitude')
                                        {{ old('lat') }}
                                    @endslot
                                    @slot('longitude')
                                        {{ old('lon') }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description') }}
                                    @endslot
                                    @slot('logo')
                                        {{ old('logo') }}
                                    @endslot
                                    @slot('slides')
                                        {{ old('slides') }}
                                    @endslot
                                    @slot('pageLink')
                                        {{ old('page_link') }}
                                    @endslot
                                    @slot('shareLink')
                                        {{ old('share_link') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Create Organisation
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
 @include('categories.handler', ['parents' => ['organisation'], 'selected' => 'organisation'])
@endsection
@section('scripts')
    <script>
        // Form Persistence
        const organisationForm = document.getElementById('organisationForm');
        FormPersistence.persist(organisationForm, {
            useSessionStorage: true
        });
    </script>
@endsection
