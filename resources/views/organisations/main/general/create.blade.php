@section('title', 'General Settings')

@extends('layouts.app')

@section('content')
    <div id="safeguard">
        <div id="general">
            <div class="general-inner container py-5">
                <div class="row">
                    <div class="col-md-5">
                        <a href="{{ route('organisations.show', $organisation->uuid) }}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-chevron-left"></i> Back To Organisation</a>
                        <h3 class="card-title font-weight-bold mb-3">Working Schedule</h3>
                        {{-- display list of work --}}
                        @if (count($organisation->schedules))
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organisation->schedules as $schedule)
                                            <tr>
                                                <td class="font-weight-bold">{{ Config::get('site_variables.days')[$schedule->day_of_week] }}</td>
                                                <td>{{ date('g:i a', strtotime("{$schedule->time_open}:00")) }}</td>

                                                <td>{{ date('g:i a', strtotime(Helper::sumTime($schedule->time_open, $schedule->work_duration)->isFullyFormatted())) }}</td>
                                                <td>
                                                    <form class="d-inline" action="{{ route('organisations.general.work.delete', [$organisation->uuid, $schedule->id]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="lead">No working schedule has been set</p>
                        @endif
                        <h3 class="card-title font-weight-bold mb-3">Social Links</h3>
                        @if (count($organisation->social))
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Tag</th>
                                            <th>Social</th>
                                            <th>Share</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organisation->social as $social)
                                            <tr>
                                                <td>{{ $social->social->name }}</td>
                                                <td>{{ $social->social->tag }}</td>
                                                <td><a href="{{ $social->page_link }}" target="_blank">{{ $social->page_link }}</a></td>
                                                <td><a href="{{ $social->share_link }}" target="_blank">{{ $social->share_link }}</a></td>
                                                <td>
                                                    <form class="d-inline" action="{{ route('organisations.general.social.delete', [$organisation->uuid, $social->id]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="lead">No social links found</p>
                        @endif
                    </div>
                    <div class="col-md-7">
                        @include('components.messages')
                        @include('components.errors')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('organisations.general.store', $organisation->uuid) }}" method="post">
                                    @csrf
                                    <div class="form-group" id="working-hours">
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="font-weight-bold">
                                                Work Schedule <small class="text-muted">(click button on the right to add variations of your working days)</small>
                                            </span>
                                            <button type="button" id="input-generator" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group" id="social-elements">
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="font-weight-bold">
                                                Social Links <small class="text-muted">(click button on the right to add more of your social media links)</small>
                                            </span>
                                            <button type="button" id="social-input-generator" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Update General</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
