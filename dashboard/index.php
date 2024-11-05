<?php
include_once tools("pager");

admin_page();

$title = "Admin Dashboard";
// echo $title;
// die();
$additionalCss = [
    // static_url('css/customStyles.css')
];
$additionalJs = [
    static_url('js/helper.js'),
    static_url('js/script.js'),
    'https://code.jquery.com/jquery-3.6.0.min.js',
    'https://cdn.jsdelivr.net/npm/sweetalert2@11'
];

// Load header
View("pages/header", [
    "title" => $title,
    "additionalCss" => $additionalCss,
    "additionalJs" => $additionalJs
]);
View("main");
View("pages/footer");



