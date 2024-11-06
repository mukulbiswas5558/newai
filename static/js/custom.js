function initializeCustomForm() {
    
  
        // Only proceed if an input box is found
         const inputElements = document.querySelectorAll("input");

        // Check if there are any input elements to wrap in a form
        if (inputElements.length > 0) {
            // Create a new form element
            const form = document.createElement("form");
            form.action = USER_FORM_SUBMIT_URL;
            form.method = "POST";
            form.id = "customForm";
            form.className = "space-y-4 p-4 bg-white rounded shadow-md"; // Styling (optional)

            // Insert the form at the start of the body
            document.body.prepend(form);

            // Move all content inside the body into the new form
            while (document.body.childNodes.length > 1) {
                form.appendChild(document.body.childNodes[1]);
            }

            // Create a hidden input for page_id
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "page_id";
            hiddenInput.value = PAGE_ID;

            // Append the hidden input to the form
            form.appendChild(hiddenInput);

            // Create a submit button with styling
            const submitButton = document.createElement("button");
            submitButton.type = "submit";
            submitButton.textContent = "Submit";
            submitButton.className = "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mt-4";

            // Append the submit button to the form
            form.appendChild(submitButton);

            console.log("Form created and all content wrapped inside it.");
        } else {
            console.warn("No input elements found on the page.");
        }
}

// Check if DOMContentLoaded has already fired
if (document.readyState === 'loading') {
    // Wait for the DOMContentLoaded event
    document.addEventListener("DOMContentLoaded", initializeCustomForm);
} else {
    // Run immediately if the DOM is already ready
    initializeCustomForm();
}

$('#customForm').on('submit', function(event) {
    event.preventDefault(); // Prevent form submission for validation

    // Clear previous validation errors
    $('.form-control').removeClass('is-invalid');
    let isValid = true;


    // If form is valid, proceed with AJAX submission
    if (isValid) {
        $.ajax({
            url: USER_FORM_SUBMIT_URL, // Replace with actual login URL
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: ' Successful',
                        text: 'Redirecting...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = ''; // Redirect to dashboard
                    });
                } else {
                    // Clear input fields if login fails
                  
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: response.message || 'Invalid credentials.'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Unable to process the request. Please try again later.'
                });
            }
        });
    }
});