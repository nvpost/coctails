<?php

$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$ing_name = $_GET["ingredient"];

//echo "<h1>Коктейли на '{$ing_name}'</h1>";

//$cache_key = $_SERVER['REQUEST_URI'].'_ings';
//
//$dataCache= new DataCache($cache_key);
//$getDataFromCache = $dataCache->initCacheData();
//if(!$getDataFromCache){
//    c_deb('нет кеша ing_page');
//    $coctail_ids = $sqlClass->table("ingredients")
//        ->select("coctail_id")
//        ->where("ingredient='".$ing_name."'")
//        ->all();
//
//
//    $coctail_id = getCoctailIds($cache_key);
//
//    deb($coctail_id);
//
//    $dataCache->updateCacheData($coctail_ids);
//}
//else{
//    c_deb('из кеша ing_page');
//    $coctail_id = $dataCache->getCacheData();
//}


$coctail_ids = $sqlClass->table("ingredients")
    ->select("coctail_id")
    ->where("ingredient='".$ing_name."'")
    ->all();








