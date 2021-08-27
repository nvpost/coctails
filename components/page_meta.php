<?php

$main_title = "Коктейли. Рецепты и ингредиенты";
$main_short_title = "Коктейли";

$meta= new MetaClass();
if(!$filters){
    echo $meta->title($main_title);
}else{
    $title = $main_short_title.". ".doFileredTitle($filters);
    echo $meta->title($title);
}

function doFileredTitle($filters){
    $text = "";
    $tagsArr = [];
    foreach ($filters as $key=>$t){
        $tagsArr[] = str_replace(';', ', ', $t);
    }
    $text = implode(', ', $tagsArr);
    return $text;
}
