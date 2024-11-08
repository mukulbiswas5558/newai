<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default Title' ?></title>
    
    <!-- Default CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Dynamically load additional CSS files -->
    <?php if (!empty($additionalCss)): ?>
        <?php foreach ($additionalCss as $cssFile): ?>
            <link rel="stylesheet" href="<?= $cssFile ?>">
        <?php endforeach; ?>
    <?php endif; ?> 

    <script>
        const LOGIN_URL = "<?= url('auth/login') ?>";
        const DASHBOARD_URL = "<?= url('dashboard') ?>";
        const FORM_SUBMIT_URL = "<?= url('dashboard/submit') ?>";
        const USER_FORM_SUBMIT_URL = "<?= url('forms/user_form_submit') ?>";
        const PAGE_ID = "<?= $page_id ?? null; ?>";
    </script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- Dynamically load additional JS files -->
    <?php if (!empty($additionalJs)): ?>
        <?php foreach ($additionalJs as $jsFile): ?>
            <script defer src="<?= $jsFile ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Inline Styles -->
    <style>
        * {
            box-sizing: border-box;
        }
        .resizable {
            position: relative;
            resize: both;
            overflow: auto;
            min-height: 50px;
            min-width: 100px;
        }
        .resizable:active {
            cursor: nesw-resize;
        }
        .highlight-avenger-component:hover {
            background-color: #f0f0f0;
            border: 3px dashed seagreen;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen overflow-hidden">
