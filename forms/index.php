<?php
include_once tools("pager");


$pageId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the page data from the database
$pageData = row("SELECT * FROM page WHERE id = :id", ['id' => $pageId]);

// Default values if no data is found
$pageTitle = $pageData['title'] ?? 'Default Title';
$pageDescription = $pageData['description'] ?? 'Default Description';
$pageCategory = $pageData['category'] ?? 'General';
$pageSubcategory = $pageData['subcategory'] ?? 'Subcategory';
$pageContent = $pageData['content'] ?? '<div>No content available.</div>';

View("pages/header", ["title" => $pageTitle]);
?>

<div class="container mt-5">
    <div class="mb-3">
        <h3 contenteditable="true" name="title" class="editable-heading"><?= htmlspecialchars($pageTitle) ?: "Page title" ?></h3>
    </div>
    <div class="mb-3">
        <p contenteditable="true" name="description" class="editable-paragraph"><?= htmlspecialchars($pageDescription) ?: "Page description" ?></p>
    </div>
    <div class="mb-3">
        <h3 contenteditable="true" name="category" class="editable-heading"><?= htmlspecialchars($pageCategory) ?: "Page category" ?></h3>
    </div>
    <div class="mb-3">
        <p contenteditable="true" name="subcategory" class="editable-paragraph"><?= htmlspecialchars($pageSubcategory) ?: "Page subcategory" ?></p>
    </div>

    <div id="components" class="component-wrapper mb-3">
        <?= $pageContent ?>
    </div>
</div>

<?php
View("pages/footer");
?>
