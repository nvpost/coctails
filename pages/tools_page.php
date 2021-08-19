<?php

$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$tool_name = $_GET["tools"];

//echo "<h1>Коктейли с применением '{$tool_name}'</h1>";

$coctail_ids = $sqlClass->table("tools")
    ->select("coctail_id")
    ->where("name='".$tool_name."'")
    ->all();


$coctail_id = getCoctailIds($coctail_ids);



