const moment = require("moment");

(function() {
    // constants
    const weekdayNames = Array.apply(null, Array(7)).map((_, i) =>
        moment(i, "e").format("dddd")
    );

    const hoursPerDay = 24;
    let counter = 0;
    const generator = document.getElementById("input-generator");
    const container = document.getElementById("working-hours");

    // call function to generate inputs
    if (generator) {
        generator.addEventListener(
            "click",
            function(e) {
                generateInputs();
            }.bind(this)
        );
    }

    // run generate inputs for initial input display
    generateInputs();

    function generateInputs() {
        ++counter;

        // bringing it all together
        const element = generateDivElement("input-group mb-2");

        // first select - Week days display
        const daySelect = generateOptionsForSelect(
            weekdayNames,
            generateSelectInput(counter, "day_of_week[]")
        );

        // destructure array
        const fh = generateHours();

        // second select - Time display
        const timeSelect = generateOptionsForSelect(
            fh,
            generateSelectInput(counter, "time_open[]")
        );

        // number input - Duration
        const numberInput = generateNumberInput(counter, "work_duration[]");

        //
        // add a span and div
        const divAppend = generateDivElement("input-group-append");
        const spanInput = generateSpanElement("input-group-text");
        spanInput.innerHTML = "hrs";

        // append span to appender
        divAppend.appendChild(spanInput);
        // add to element
        element.appendChild(daySelect);
        element.appendChild(timeSelect);
        element.appendChild(numberInput);
        element.appendChild(divAppend);

        if (container) {
            container.appendChild(element);
        }
    }

    // <!-- Creation of elements for reuse -->
    function generateDivElement(className) {
        const d = document.createElement("div");
        d.className = className;

        return d;
    }

    function generateSpanElement(className) {
        const s = document.createElement("span");
        s.className = className;

        return s;
    }

    function generateNumberInput(counter, name) {
        // init input globally
        const input = document.createElement("input");

        // generate inputs
        input.id = `${name.split("_").join("-")}-${counter}`;
        input.type = "number";
        input.name = name;
        input.placeholder = "Work Duration";
        input.min = 1;
        input.max = 24;
        input.className = `form-control`;
        input.value = 1;
        input.required = "required";
        return input;
    }

    function generateSelectInput(counter, name) {
        const select = document.createElement("select");
        // generate select
        select.id = `${name.split("_").join("-")}-${counter}`;
        select.name = name;
        select.className = `form-control`;
        select.required = "required";
        select.options.add;

        return select;
    }

    function generateOptionsForSelect(data, parentSelect) {
        // set values and items
        for (let d in data) {
            let option = document.createElement("option");

            option.value = d;
            option.text = data[d];

            parentSelect.appendChild(option);
        }

        return parentSelect;
    }

    // <!-- End of elements creation -->

    function generateHours() {
        let keyValueHours = {};
        let tracker = 1;
        for (let i = 1; i <= hoursPerDay; i++) {
            if (i < 12) {
                keyValueHours[i] = `${i}:00 AM`;
            } else if (i == 12) {
                keyValueHours[i] = `${i}:00 NOON`;
            } else if (i > 12) {
                keyValueHours[i] = `${tracker}:00 PM`;
                ++tracker;
            } else if (i == 24) {
                keyValueHours[i] = `${tracker}:00 AM`;
            }
        }

        return keyValueHours;
    }
})();

/* <div class="form-group bg-light">
    <div class="input-group">
        <select name="day_of_week" id="day-of-week" class="text-capitalize form-control @error('day_of_week') is-invalid @enderror" required>
            <option value selected disabled>Select Day of Week</option>
            @foreach ($weekDays as $day)
                <option value="{{ $loop->index }}" {{ $daySelected == $loop->iteration?'selected':null }}>{{ $day }}</option>
            @endforeach
        </select>
        @error('day_of_week')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
        <select name="time_open" id="time-open" class="form-control @error('time_open') is-invalid @enderror" required>
            <option value selected disabled>Select Time of Day</option>
            @foreach ($dayTimes as $time)
                <option value="{{ $loop->iteration }}" {{ $timeSelected == $loop->iteration?'selected':null }}>{{ $time }}</option>
            @endforeach
        </select>
        @error('time_open')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
        <input type="number" min="1" max="24" class="form-control @error('work_duration') is-invalid @enderror" name="work_duration" placeholder="Work Duration" id="work-duration" value="{{ $durationSelected?$durationSelected:1 }}">
        @error('work_duration')
            <p class="invalid-feedback">
                {{ $message }}
            </p>
        @enderror
        <div class="input-group-append">
            <span class="input-group-text text-muted">hrs</span>
            <button class="btn btn-primary" title="Click To Add More"><i class="fas fa-plus"></i></button>
        </div>
    </div>
</div> */
