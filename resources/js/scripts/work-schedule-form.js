const moment = require("moment");

(function() {
    // constants
    const weekdayNames = Array.apply(null, Array(7)).map((_, i) =>
        moment(i, "e").format("dddd")
    );

    const hoursPerDay = 24;
    let counter = 0;
    let scounter = 0;
    const generator = document.getElementById("input-generator");
    const container = document.getElementById("working-hours");
    const socialGenerator = document.getElementById("social-input-generator");
    const socialElement = document.getElementById("social-elements");

    // call function to generate inputs
    if (generator) {
        generator.addEventListener(
            "click",
            function(e) {
                generateInputs();
            }.bind(this)
        );
    }

    // social elements elements generator button

    if (socialGenerator) {
        socialGenerator.addEventListener(
            "click",
            function(e) {
                generateSocialInputs();
            }.bind(this)
        );
    }
    // run generate inputs for initial input display
    generateInputs();
    generateSocialInputs();

    // social inputs
    function generateSocialInputs() {
        ++scounter;

        const element = generateDivElement("input-group mb-2");

        // social tags display
        const social = {
            1: "Facebook",
            2: "Twitter",
            3: "Instagram",
            4: "Linked-in",
            5: "Pinterest",
            6: "Tumblr"
        };

        const socialMedia = generateOptionsForSelect(
            social,
            generateSelectInput(scounter, "social_id[]")
        );

        // url social
        const socialLink = generateUrlInput(
            scounter,
            "page_link[]",
            "Social Link"
        );

        // url share link
        const shareLink = generateUrlInput(
            scounter,
            "share_link[]",
            "Share Link"
        );

        // add to element
        element.appendChild(socialMedia);
        element.appendChild(socialLink);
        element.appendChild(shareLink);

        if (socialElement) {
            socialElement.appendChild(element);
        }
    }
    // working day inputs
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

    function generateUrlInput(counter, name, placeholder) {
        const input = document.createElement("input");

        // generate props
        input.id = `${name
            .replace("[]", "")
            .split("_")
            .join("-")}-${counter}`;
        input.type = "url";
        input.name = name;
        input.placeholder = placeholder;
        input.className = `form-control`;
        input.pattern = `https?://.*`;
        return input;
    }

    function generateNumberInput(counter, name) {
        // init input globally
        const input = document.createElement("input");

        // generate inputs
        input.id = `${name
            .replace("[]", "")
            .split("_")
            .join("-")}-${counter}`;
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
        select.id = `${name
            .replace("[]", "")
            .split("_")
            .join("-")}-${counter}`;
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
