<?php

$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$ing_name = $_GET["ingredient"];

echo "<h1>Коктейли на '{$ing_name}'</h1>";

$coctail_ids = $sqlClass->table("ingredients")
    ->select("coctail_id")
    ->where("ingredient='".$ing_name."'")
    ->all();


$coctail_id = getCoctailIds($coctail_ids);

require_once 'components/tags.php';

require_once 'main.php';