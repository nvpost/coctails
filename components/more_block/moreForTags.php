<?php




$intag = "'" . implode("', '", $flat_tags) . "'";


$sqlMoreClass = new SQLModelClass();
$countMoreCoctailsClass = new SQLModelClass();

$where = "tags.tag IN (".$intag.")";
$where .=" AND tags.coctail_id = coctails.coctail_id AND coctails.name NOT IN('".$coctail['name']."')";

$moreCoctails = $sqlMoreClass->table('tags, coctails')
    ->select("tags.coctail_id, coctails.*")
    ->where($where)
    ->all();


$slicedMoreCoctails = array_slice($moreCoctails, 0, 20);

$slicedMoreCoctails = array_map("unserialize", array_unique(array_map("serialize", $slicedMoreCoctails)));


$catalogHtml = new CatalogWidgetClass($slicedMoreCoctails);
$catalog = $catalogHtml->getCatalogItem();
require 'components/catalogWidget.php';
