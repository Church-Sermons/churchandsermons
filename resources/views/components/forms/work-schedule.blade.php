<div class="form-row mb-2">
    <div class="col-md-5">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="open-hours-always" name="open_hours" value="1" checked>
            <label class="custom-control-label" for="open-hours-always">Alway Open</label>
        </div>
    </div>
    <div class="always-container col-md-7 d-none">
        <div class="form-row">
            <div class="form-group col-md-5">
                <select name="o_time_open" id="time-open" class="form-control">
                    <option value disabled selected>Start Time</option>
                    @foreach (Handler::generateTime() as $time)
                        <option value="{{ $loop->iteration }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <input type="number" name="o_work_duration" class="form-control" id="work-duration" min="1" max="24" value="1">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="open-hours-selected" name="open_hours" value="2">
        <label class="custom-control-label" for="open-hours-selected">Selected Days</label>
    </div>
</div>
<div class="selected-container d-none">
    @foreach (Config::get('site_variables.days') as $key=>$value)
        <div class="form-row">
            <div class="form-group col-md-5">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="day-of-week-{{ $key }}" name="day_of_week[]" value="{{ $key }}">
                    <label class="custom-control-label" for="day-of-week-{{ $key }}">{{ $value }}</label>
                </div>
            </div>
            <div class="form-group col-md-7">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select name="time_open[]" id="time-open-{{ $key }}" class="form-control">
                            <option value disabled selected>Start Time</option>
                            @foreach (Handler::generateTime() as $time)
                                <option value="{{ $loop->iteration }}">{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" name="work_duration[]" class="form-control" id="work-duration" min="1" max="24" value="1">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="form-group">
    <button class="btn btn-custom" type="submit">{{ $submitText }}</button>
</div>
@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const alwaysOpen = document.getElementById("open-hours-always");
        const selectHours = document.getElementById("open-hours-selected");

        // alway and selected containers
        const alwaysContainer = document.querySelector(".always-container");
        const selectedContainer = document.querySelector(".selected-container");
        // if checked display corresponding else hide
        if(alwaysOpen && alwaysOpen.checked){
            // display always container
            alwaysContainer && alwaysContainer.classList.remove("d-none");
        }else if(selectHours && selectedContainer){
            selectedContainer && selectedContainer.classList.remove("d-none");
        }

        /* Queued for update */
        // check if change is selected
        if(alwaysOpen){
            // event listener
            alwaysOpen.addEventListener("change", function(){
                if(this.checked){
                    selectedContainer.classList.add("d-none");
                    alwaysContainer.classList.remove("d-none");
                }else{
                    alwaysContainer.classList.add("d-none");
                }
            })
        }

        if(selectHours){
            // event listener
            selectHours.addEventListener("change", function(){
                if(this.checked){
                    alwaysContainer.classList.add("d-none");
                    selectedContainer.classList.remove("d-none");
                }else{
                    selectedContainer.classList.add("d-none");
                }
            })
        }
        /* Queued for update end */

        // get toggler
        const toggler = document.querySelectorAll(".input-toggler");

        // if(toggler){
        //     Array.from(toggler).forEach(function(t){
        //         t.addEventListener("click", function(){
        //             // generate new elements
        //         })
        //     })
        // }

        // function generateSelectBox()
        // SHELVED
    })
    </script>
@endsection

