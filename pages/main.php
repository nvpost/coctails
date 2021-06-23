<?php



require_once 'components/tags.php';

//deb($page);

$frontStart = $page*$limit+1;
$frontFin = ($page+1)*$limit;

$set_limit = $page*$limit.", ".$limit;


$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$allCoctails = $sqlClass->table('coctails')
    ->select('*')
    ->limit($set_limit)
    ->where(1)
    ->all();
//deb($set_limit);
$countCoctails = $countCoctailsClass->table('coctails')
    ->select('*')
    ->where(1)
    ->count();


$catalogHtml = new CatalogWidgetClass($allCoctails);




require_once 'components/page_header.php';
echo "<div class='container'>";

echo $catalogHtml->getCatalogItem();

echo "</div>";

echo "<div class='pagination'>";
//    deb($countCoctails);
    drowPagination($countCoctails);
echo "</div>";