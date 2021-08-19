<?php

function moreCoctailsFoo($arr, $table, $field){
    global $coctail;

    $flat_arr = array_column($arr, $field);
    $intarr = "'" . implode("', '", $flat_arr) . "'";


    $sqlMoreClass = new SQLModelClass();
    $countMoreCoctailsClass = new SQLModelClass();

    $where = "{$table}.{$field} IN (".$intarr.")";
    $where .=" AND {$table}.coctail_id = coctails.coctail_id AND coctails.name NOT IN('".$coctail['name']."')";

    $moreCoctails = $sqlMoreClass->table("{$table}, coctails")
        ->select("{$table}.coctail_id, coctails.*")
        ->where($where)
        ->all();


    $slicedMoreCoctails = array_slice($moreCoctails, 0, 20);

    $slicedMoreCoctails = array_map("unserialize", array_unique(array_map("serialize", $slicedMoreCoctails)));

    $catalogHtml = new CatalogWidgetClass($slicedMoreCoctails);
    $catalog = $catalogHtml->getCatalogItem();
//    require 'components/catalogWidget.php';
    echo "<div class='catalog_container'>";

    echo $catalog;
    echo "</div>";

}