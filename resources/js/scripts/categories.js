document.addEventListener("DOMContentLoaded", function() {
    // Make CRUD Request on categories
    // get category form
    const form = document.getElementById("categoryForm");

    // check for nullability
    if (form) {
        // check for submit and prevent submit
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            // get form data
            const formData = new FormData(e.target);

            if (formValidation(formData)) {
                // create data
                const category = {
                    name: formData.get("name"),
                    linked_to: formData.get("linked_to")
                };

                submitCategory(category);
            }
        });
    }

    // validate form
    function formValidation(data) {
        if (data.get("name") && data.get("linked_to")) {
            if (data.get("name").length <= 255) {
                return true;
            }
        }
        return false;
    }

    // make request to server to send category post data
    async function submitCategory(category) {
        try {
            const response = await axios.post(
                "/categories/store-json",
                category
            );
            const { data } = response;

            // display server message
            const alertBox = `<div class='alert alert-${data.status} fade show'>${data.message}</div>`;
            document.querySelector(".message-area").innerHTML = alertBox;

            // reset form
            form.reset();

            // reload page
            setTimeout(() => window.location.reload(), 2000);
        } catch (error) {
            console.log(error);
        }
    }

    // Toggle Image and Image Url Display
    const imageCheck = document.querySelectorAll(".image-check");
    let holder;

    if (imageCheck) {
        Array.from(imageCheck).forEach(function(v) {
            // get attribute of checked element
            if (v.checked) {
                // store id of checked on page load
                holder = v.getAttribute("data-target");
            }

            if (!v.checked) {
                // console.log(v.getAttribute('data-target'));
                // hide unchecked elements
                hideElement(
                    document.getElementById(v.getAttribute("data-target"))
                );
            }

            v.addEventListener("change", function(e) {
                // use previously stored holder var to hide element
                hideElement(document.getElementById(holder));
                // change value of holder var to hold id of currently checked id
                holder = this.getAttribute("data-target");
                // display currently checked element
                displayElement(document.getElementById(holder));
            });
        });
    }

    // function to show element
    function displayElement(el) {
        el.style.display = "block";
    }

    // function to hide element
    function hideElement(el) {
        el.style.display = "none";
    }

    const image = document.querySelector("input[type='file']");
    const imageUrl = document.getElementById("image-url");
    if (image) {
        image.addEventListener("change", function(e) {
            if (this.files[0].name) {
                // change label
                document.querySelector(
                    `#${e.target.id} + label`
                ).innerHTML = this.files[0].name;
                // disable textbox
                // imageUrl.disabled = true;
            }
        });

        // imageUrl.addEventListener("input", function(e) {
        //     image.disabled = true;
        // });
    }
});
