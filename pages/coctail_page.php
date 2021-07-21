<?php

$coctail_name = $_GET['coctail'];
deb($coctail_name);

//$table = 'coctails, tags, ingredients, tools';
//$select = 'coctails.*, tags.*, ingredients.*, tools.*';
//$where = "coctails.en_name='".$coctail_name."'
//AND coctails.coctail_id = tags.coctail_id
//AND coctails.coctail_id = ingredients.coctail_id
//AND coctails.coctail_id = tools.coctail_id";

$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$coctail = $sqlClass->table("coctails")
    ->select("*")
    ->where("coctails.en_name='".$coctail_name."'")
    ->one();
deb($coctail);

$coctail_tags = $sqlClass->table("tags")
    ->select("*")
    ->where("tags.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_tags);

$coctail_ingredients = $sqlClass->table("ingredients")
    ->select("*")
    ->where("ingredients.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_ingredients);


require_once 'components/coctailPageWidget.php';