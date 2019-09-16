@foreach (Config::get('site_variables.days') as $key=>$value)
    <div class="form-row">
        <div class="form-group col-md-8">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="work-day-{{ $key }}" name="work_day" value="{{ $key }}">
                <label class="custom-control-label" for="work-day-{{ $key }}">{{ $value }}</label>
            </div>
        </div>
        <div class="form-group col-md-2">
            <select name="work_time" id="work-time-{{ $key }}">
                <option value disabled selected>Start Time</option>
                @foreach (Handler::generateTime() as $time)
                    <option value="{{ $loop->iteration }}">{{ $time }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <input type="number" name="work_duration" id="work-duration" min="1" max="24" value="1">
        </div>
    </div>
@endforeach


