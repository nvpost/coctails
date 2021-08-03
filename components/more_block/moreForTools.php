<?php

//deb($coctail_ingredients);
$flat_tools = array_column($coctail_tools, 'name');
$in_tools = "'" . implode("', '", $flat_tools)."'";
//deb($in_tools);

$sqlMoreClass = new SQLModelClass();
$countMoreCoctailsClass = new SQLModelClass();

$where = "tools.name IN (".$in_tools.")";
$where .=" AND tools.coctail_id = coctails.coctail_id AND coctails.name NOT IN('".$coctail['name']."')";
$moreCoctails = $sqlMoreClass->table('tools, coctails')
    ->select("tools.coctail_id, coctails.*")
    ->where($where)
    ->all();


$slicedMoreCoctails = array_slice($moreCoctails, 0, 20);

$slicedMoreCoctails = array_map("unserialize", array_unique(array_map("serialize", $slicedMoreCoctails)));

$catalogHtml = new CatalogWidgetClass($slicedMoreCoctails);
$catalog = $catalogHtml->getCatalogItem();
require 'components/catalogWidget.php';