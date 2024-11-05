<?php
include_once tools("pager");

// Get page data from the database
$pageId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$pageData = row("SELECT * FROM page WHERE id = :id", ['id' => $pageId]);

// Define page variables with default values
$pageTitle = $pageData['title'] ?? 'Default Title';
$pageContent = $pageData['content'] ?? '<div>No content available.</div>';

// Define additional CSS and JS files dynamically
$additionalCss = [
    // static_url('css/customStyles.css')
];
$additionalJs = [
    // static_url('js/helper.js'),
    // static_url('js/script.js'),
      
    'https://code.jquery.com/jquery-3.6.0.min.js',
    'https://cdn.jsdelivr.net/npm/sweetalert2@11',
    static_url('js/custom.js')

];

// Load header
View("pages/header", [
    "title" => $pageTitle,
    "additionalCss" => $additionalCss,
    "additionalJs" => $additionalJs,
    "page_id" => $pageId
]);

// Render page content
echo $pageContent;
?>

<?php
// Load footer
View("pages/footer", ["page_id" => $pageId]);
?>
