<?php

$coctail_name = $_GET['coctail'];


$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$coctail = $sqlClass->table("coctails")
    ->select("*")
    ->where("coctails.en_name='".$coctail_name."'")
    ->one();

$process = explode("; ", $coctail['process']);


$coctail_tags = $sqlClass->table("tags")
    ->select("*")
    ->where("tags.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_tags);


$coctail_tools = $sqlClass->table("tools")
    ->select("*")
    ->where("tools.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_tools);

$coctail_ingredients = $sqlClass->table("ingredients")
    ->select("*")
    ->where("ingredients.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_ingredients);



require_once 'components/coctailPageWidget.php';