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
                        <a class="nav-link" href="<?= url('auth/login') ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>