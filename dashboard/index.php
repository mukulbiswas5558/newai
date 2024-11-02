<?php
include_once tools("pager");

admin_page();

$title = "Avenger";
// echo $title;
// die();
View("header", ["title" => $title]);
View("card", ["title" => $title, "content" => $title]);

?>
