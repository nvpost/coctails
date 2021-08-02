<?php



foreach ($tags->tags as $t){
    deb($t['tag']);


    $sqlMoreClass = new SQLModelClass();
    $countMoreCoctailsClass = new SQLModelClass();

    $where = "tags.tag = '".$t['tag']."'";
    $where .=" AND tags.coctail_id = coctails.coctail_id";
    $moreCoctails = $sqlMoreClass->table('tags, coctails')
        ->select("*")
        ->where($where)
        ->all();

    deb(count($moreCoctails));
    $slicedMoreCoctails = array_slice($moreCoctails, 0, 5);
//    deb($slicedMoreCoctails);

    $catalogHtml = new CatalogWidgetClass($slicedMoreCoctails);

    $catalog = $catalogHtml->getCatalogItem();

    require 'components/catalogWidget.php';
    deb(count($randMoreCoctails));


}