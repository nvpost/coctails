<?php

//deb($_GET);

//SELECT coctails.*, tags.* FROM coctails, tags WHERE tags.tag='мятные' AND tags.coctail_id = coctails.coctail_id
$tag = $_GET['tag'];
$table = 'coctails, tags';
$select = 'coctails.*, tags.*';
$where = "tags.tag='мятные' AND tags.coctail_id = coctails.coctail_id";

$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$allCoctails = $sqlClass->table($table)
    ->select($select)
    ->limit($set_limit)
    ->where($where)
    ->all();
//deb($set_limit);
$countCoctails = $countCoctailsClass->table($table)
    ->select($select)
    ->where($where)
    ->count();

//deb($countCoctails);
//deb($allCoctails);


$catalogHtml = new CatalogWidgetClass($allCoctails);
echo "<div class='container'>";
echo $catalogHtml->getCatalogItem();

echo "</div>";

echo "<div class='pagination'>";
    drowPagination($countCoctails);
echo "</div>";

