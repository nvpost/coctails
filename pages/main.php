<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});



$allCoctailsClass = new getCoctailsClass();
$allCoctails = $allCoctailsClass->getAll();

$catalogHtml = new CatalogWidgetClass($allCoctails);

echo "<div class='container'>";

echo $catalogHtml->getCatalogItem();

echo "</div>";