<script>

        $(document).ready(function () {
            $('#submitBtn').on('click', function (event) {
                event.preventDefault(); // Prevent form submission for validation

                // Clear previous validation errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                let isValid = true; // Flag to check if form is valid

                // Validate title
                const title = $('input[name="title"]').val().trim();
                if (title === '') {
                    $('input[name="title"]').addClass('is-invalid')
                        .after('<div class="invalid-feedback">Title is required.</div>');
                    isValid = false;
                }

                // Validate description
                const description = $('input[name="description"]').val().trim();
                if (description === '') {
                    $('input[name="description"]').addClass('is-invalid')
                        .after('<div class="invalid-feedback">Description is required.</div>');
                    isValid = false;
                }

                // Validate category
                const category = $('input[name="category"]').val().trim();
                if (category === '') {
                    $('input[name="category"]').addClass('is-invalid')
                        .after('<div class="invalid-feedback">Category is required.</div>');
                    isValid = false;
                }


                // Proceed if form is valid
                if (isValid) {
                    // Serialize form data
                    const formData = $('#dataForm').serializeArray();

                    // Get the HTML content inside #components div
                    const componentsHTML = $('#components').html();

                    // Add the components HTML as an additional item to the serialized form data
                    formData.push({ name: 'components', value: componentsHTML });

                    // Send data via AJAX
                    $.ajax({
                        url: "<?= url('dashboard/submit') ?>",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data submitted successfully!',
                                    text: 'Your data has been saved.',
                                    confirmButtonText: 'OK', // Custom OK button text
                                }).then(() => {
                                    location.reload(); // Refresh the page after the alert is closed
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Submission failed',
                                    text: response.message || 'An error occurred during submission.',
                                    confirmButtonText: 'OK' // Ensure the button is shown here too
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Unable to process the request. Please try again later.',
                                confirmButtonText: 'OK' // Ensure the button is shown here too
                            });
                        }
                    });
                }
            });

            // Remove is-invalid class and error message on input focus
            $('.form-control').on('focus', function () {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
        });

        
    </script>

</body>

</html>