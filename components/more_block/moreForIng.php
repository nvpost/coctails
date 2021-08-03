<?php

//deb($coctail_ingredients);
$flat_ingredients = array_column($coctail_ingredients, 'ingredient');
$inIngredients = "'" . implode("', '", $flat_ingredients)."'";
//deb($inIngredients);

$sqlMoreClass = new SQLModelClass();
$countMoreCoctailsClass = new SQLModelClass();

$where = "ingredients.ingredient IN (".$inIngredients.")";
$where .=" AND ingredients.coctail_id = coctails.coctail_id AND coctails.name NOT IN('".$coctail['name']."')";
$moreCoctails = $sqlMoreClass->table('ingredients, coctails')
    ->select("ingredients.coctail_id, coctails.*")
    ->where($where)
    ->all();


$slicedMoreCoctails = array_slice($moreCoctails, 0, 20);

$slicedMoreCoctails = array_map("unserialize", array_unique(array_map("serialize", $slicedMoreCoctails)));

$catalogHtml = new CatalogWidgetClass($slicedMoreCoctails);
$catalog = $catalogHtml->getCatalogItem();
require 'components/catalogWidget.php';