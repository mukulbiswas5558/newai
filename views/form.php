<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop Page Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script>
        const LOGIN_URL = "<?= url('auth/login') ?>";
        const DASHBOARD_URL = "<?= url('dashboard') ?>";
        const FORM_SUBMIT_URL = "<?= url('dashboard/submit') ?>";
        const USER_FORM_SUBMIT_URL = "<?= url('forms/user_form_submit') ?>";
        const PAGE_ID = "<?= $page_id ?? null; ?>
    ";

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script defer src="<?= static_url('js/helper.js') ?>"></script>
    <script defer src="<?= static_url('js/script.js') ?>"></script>
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

<?= $pageContent ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pageId = "<?= $pageId ?? null; ?>"; // Get PHP variable or set to null
        const customForm = document.getElementById("customForm");

        // Create a hidden input element
        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "page_id";
        hiddenInput.value = pageId;

        // Append the hidden input to the form
        customForm.appendChild(hiddenInput);
    });
</script>
</body>


</html>