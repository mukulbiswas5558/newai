<?php
include_once tools("pager");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://static.vecteezy.com/system/resources/previews/008/296/267/non_2x/colorful-swirl-logo-design-concept-illustration-vector.jpg"
        rel="icon">

    <title>Page Maker - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .component-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            overflow-x: auto;
            border: 1px dashed #ccc;
            padding: 10px;
        }

        .component {
            width: 300px;
            min-width: 300px;
            cursor: move;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .draggable {
            opacity: 0.5;
        }

        .dropzone {
            border: 2px dashed #007bff;
            padding: 10px;
            margin-top: 10px;
        }

        .navbar-brand img {
            height: 30px;
            /* Set height for logo */
        }

        .btn-success {
            background-color: #0d6efd;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://static.vecteezy.com/system/resources/previews/008/296/267/non_2x/colorful-swirl-logo-design-concept-illustration-vector.jpg"
                    alt="Logo" class="me-2"> <!-- Dummy logo image -->
                Page Maker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('auth/logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Create New Page</h1>



        <form id="dataForm">
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Page title" required>
            </div>
            <div class="mb-3">
                <input type="text" name="description" class="form-control" placeholder="Page description" required>
            </div>
            <div class="mb-3">
                <input type="text" name="category" class="form-control" placeholder="Page category" required>
            </div>
            <div class="mb-3">
                <input type="text" name="subcategory" class="form-control" placeholder="Page subcategory" required>
            </div>

            <!-- Dynamically generated components -->


            <div class="text-center">
                <button type="button" id="submitBtn" class="btn btn-primary">Export</button>
            </div>
        </form>


        <div id="components" class="component-wrapper mb-3">

        </div>



        <div id="available-components" class="mb-3">
            <h5>Available Components</h5>
            <div class="component card p-3 mb-3 border" draggable="true" data-type="accordion">
                <h5>Accordion</h5>
            </div>
            <div class="component card p-3 mb-3 border" draggable="true" data-type="card">
                <h5>Card</h5>
            </div>
            <div class="component card p-3 mb-3 border" draggable="true" data-type="form">
                <h5>Form</h5>
            </div>
        </div>

    </div>

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

        let componentIndex = 0;

        // Handle drag start
        $(document).on('dragstart', '.component', function (e) {
            $(this).addClass('draggable');
            e.originalEvent.dataTransfer.setData('text/plain', $(this).data('type'));
        });

        // Handle drag end
        $(document).on('dragend', '.component', function () {
            $(this).removeClass('draggable');
        });

        // Allow dropping on the components wrapper
        $('#components').on('dragover', function (e) {
            e.preventDefault(); // Prevent default to allow drop
        });

        // Handle drop event
        $('#components').on('drop', function (e) {
            e.preventDefault();
            const type = e.originalEvent.dataTransfer.getData('text/plain');
            $(this).append(getComponentHtml(componentIndex++, type));
        });

        // Generate the component HTML template based on type
        function getComponentHtml(index, type) {
            let componentHtml = `
                <div class="component card p-3 mb-3 border" data-index="${index}" draggable="true">
                    <h5>${type.charAt(0).toUpperCase() + type.slice(1)} #${index + 1}</h5>
                    <button type="button" class="btn btn-danger remove-component">Remove</button>
                    <div class="dynamic-fields mt-3"></div>
                </div>
            `;

            // Customizing HTML for different types
            if (type === 'form') {
                componentHtml = `
                    
                        <div class="dynamic-fields mt-3">
                            ${getFormFieldsHtml()}
                        </div>
                       
                `;
            } else if (type === 'card') {
                componentHtml = `
                    <div class="component card p-3 mb-3 border" data-index="${index}" draggable="true">
                        <h5>Card #${index + 1}</h5>
                        <textarea name="components[${index}][content]" class="form-control mb-2" placeholder="Card Content"></textarea>
                    </div>
                `;
            } else if (type === 'accordion') {
                componentHtml = `
                    <div class="component card p-3 mb-3 border" data-index="${index}" draggable="true">
                        <h5>Accordion #${index + 1}</h5>
                        <input type="text" name="components[${index}][heading]" class="form-control mb-2" placeholder="Accordion Heading">
                        <textarea name="components[${index}][content]" class="form-control mb-2" placeholder="Accordion Content"></textarea>
                    </div>
                `;
            }
            
            return componentHtml;
        }

        // Generate dynamic form fields HTML template
        function getFormFieldsHtml() {
            return `
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="pswd">
                </div>
                <div class="form-check mb-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            `;
        }

        // Remove a component
        $(document).on('click', '.remove-component', function () {
            $(this).closest('.component').remove();
        });

        // Add more fields within the form when 'Add Field' is clicked
        $(document).on('click', '.add-field', function () {
            $(this).before(`
                <div class="form-group mb-2 field-group">
                    <input type="text" name="form_fields[][name]" class="form-control mb-2" placeholder="Field Name">
                    <select name="form_fields[][type]" class="form-select">
                        <option value="text">Text</option>
                        <option value="date">Date</option>
                        <option value="file">Image</option>
                    </select>
                    <button type="button" class="btn btn-danger mt-2 remove-field">Remove Field</button>
                </div>
            `);
        });

        // Remove a form field
        $(document).on('click', '.remove-field', function () {
            $(this).closest('.field-group').remove();
        });
    </script>

</body>

</html>