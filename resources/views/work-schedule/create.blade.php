@section('title', "{$model->name} {$model->surname} Work Schedule")

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="general">
        <div class="general-inner container py-5">
            <div class="row">
                <div class="col-md-5">
                    <a href='{{ route("{$name}.show", $model->uuid) }}' class="btn btn-sm btn-primary mb-4 text-capitalize"><i class="fas fa-chevron-left"></i> Go Back</a>
                    <h3 class="card-title font-weight-bold mb-3">Work Schedule</h3>
                    {{-- display list of work --}}
                    @if (count($model->schedules))
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
                                    @foreach ($model->schedules as $schedule)
                                        <tr>
                                            <td class="font-weight-bold">{{ Config::get('site_variables.days')[$schedule->day_of_week] }}</td>
                                            <td>{{ date('g:i a', strtotime("{$schedule->time_open}:00")) }}</td>

                                            <td>{{ date('g:i a', strtotime(Helper::sumTime($schedule->time_open, $schedule->work_duration)->isFullyFormatted())) }}</td>
                                            <td>
                                                <form class="d-inline" action="{{ route("{$name}.work-schedule.destroy", [$model->uuid, $schedule->id]) }}" method="post">
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
                </div>
                <div class="col-md-7">
                    @includeIf('components.messages')
                    @includeIf('components.errors')
                    <form action='{{ route("{$name}.work-schedule.store", $model->uuid) }}' method="POST">
                        @csrf
                        @includeIf('components.forms.work-schedule',['submitText' => 'Add Schedule'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
