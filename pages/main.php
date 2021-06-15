<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});







$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$allCoctails = $sqlClass->table('coctails')
    ->select('*')
    ->limit($limit)
    ->where(1)
    ->all();

$countCoctails = $countCoctailsClass->table('coctails')
    ->select('*')
    ->where(1)
    ->count();


$catalogHtml = new CatalogWidgetClass($allCoctails);

echo "<div class='container'>";

echo $catalogHtml->getCatalogItem();

echo "</div>";

echo "<div class='pagination'>";
//    deb($countCoctails);
    drowPagination($countCoctails);
echo "</div>";