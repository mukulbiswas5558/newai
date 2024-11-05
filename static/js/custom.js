function initializeCustomForm() {
    
        // Find the input box to wrap
        const inputBox = document.querySelector("input[type='text']"); // Adjust the selector as needed
       
    
        // Only proceed if an input box is found
        if (inputBox) {
            // Create a new form element and set its attributes
            const form = document.createElement("form");
            form.action = USER_FORM_SUBMIT_URL; // URL to submit the form to
            form.method = "POST"; // or "GET" based on your needs
            form.id = "customForm"; // Set the ID if needed
        
            // Insert the form before the inputBox in the DOM
            inputBox.parentNode.insertBefore(form, inputBox);
        
            // Move the inputBox into the form
            form.appendChild(inputBox);
        
            // Get the PAGE_ID value from your global scope or inline script
            const pageId = PAGE_ID;
        
            // Create a hidden input for page_id
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "page_id";
            hiddenInput.value = pageId;
        
            // Append the hidden input to the form
            form.appendChild(hiddenInput);
        
            // Create a submit button and style it with Tailwind CSS
            const submitButton = document.createElement("button");
            submitButton.type = "submit";
            submitButton.textContent = "Submit";
            submitButton.className = "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded";
        
            // Append the submit button to the form
            form.appendChild(submitButton);
        
            console.log("Form created with input box, hidden page_id field, and submit button.");
        } else {
            console.warn("No input box found to wrap inside the form.");
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