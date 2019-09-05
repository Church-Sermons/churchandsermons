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
});
