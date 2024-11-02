<?php
include_once tools("pager");
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://static.vecteezy.com/system/resources/previews/008/296/267/non_2x/colorful-swirl-logo-design-concept-illustration-vector.jpg" rel="icon">
    <title>Login Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            height: 30px;
        }
        .login-btn {
            width: 150px;
            transition: transform 0.3s ease;
        }

        .login-btn:hover {
            transform: scale(1.05); /* Slight scale up on hover */
        }

        /* Container styles */
        .login-container {
            margin-top: 100px;
        }
    </style>
</head>
<body>

<!-- Navbar with Logo -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="https://static.vecteezy.com/system/resources/previews/008/296/267/non_2x/colorful-swirl-logo-design-concept-illustration-vector.jpg" alt="Logo" class="me-2">
            Page Maker
        </a>
    </div>
</nav>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form id="loginForm" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <div class="invalid-feedback">Please enter a valid username.</div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="invalid-feedback">Please enter a valid password.</div>
                        </div>
                        <div class="d-flex justify-content-center"> <!-- Center button container using flex -->
                            <button type="submit" class="btn btn-primary login-btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevent form submission for validation

        // Clear previous validation errors
        $('.form-control').removeClass('is-invalid');
        let isValid = true;

        // Validate username
        const username = $('#username').val().trim();
        if (username === '') {
            $('#username').addClass('is-invalid');
            $('#username').next('.invalid-feedback').text('Username is required.');
            isValid = false;
        }

        // Validate password
        const password = $('#password').val().trim();
        if (password === '') {
            $('#password').addClass('is-invalid');
            $('#password').next('.invalid-feedback').text('Password is required.');
            isValid = false;
        }

        // If form is valid, proceed with AJAX submission
        if (isValid) {
            $.ajax({
                url: "<?= url('auth/login') ?>", // Replace with actual login URL
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Redirecting...',
                            timer: 100,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "<?= url('dashboard') ?>"; // Redirect to dashboard
                        });
                    } else {
                        // Clear input fields if login fails
                        $('#username, #password').val('');
                        

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

    // Remove is-invalid class on input focus
    $('.form-control').on('focus', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>

</body>
</html>
