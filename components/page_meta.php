<?php

$main_title = "Коктейли. Рецепты и ингредиенты";
$main_short_title = "Коктейль";



$meta= new MetaClass();
if(!$filters){
    echo $meta->title($main_title);
//    echo $meta->description($main_title);

}else{

    $coctail_en_name = doFileredTitle($filters);
    $coctail_data = getCoctailData($coctail_en_name);
    if($coctail_data){
        $coctail_name = $coctail_data['name'];
        $en_coctail_name = $coctail_data['en_name'];

        $сomposite_name = $main_short_title." ".$coctail_name.' ('.$en_coctail_name.')';

        $title = $сomposite_name.' | Рецепт коктейля '.$coctail_name;
        $descr = (strlen($coctail_data['text_info'])>2) ? doDescr($coctail_data['text_info']) : doDescr($coctail_data['process']);

        echo $meta->title($title);
        echo $meta->description($descr);
    }else{

        $filteredTitle = doFileredTitle($filters);

        echo $meta->title("Коктейли ".$title.$filteredTitle);
        echo $meta->description($main_title.". "."Коктейли ".$title.$filteredTitle);
    }




}



function doFileredTitle($filters){
    $text = "";
    $tagsArr = [];

    foreach ($filters as $key=>$t){
        c_deb($key);
        if($key=='tag'){
            $t = " - ".$t;
        }
        if($key=='ingredient'){
            $t = "Рецепт - ".$t;
        }
        if($key=='tool'){
            $t = "Использовать - ".$t;
        }
        $tagsArr[] = str_replace(';', ', ', $t);
    }
    $text = implode(', ', $tagsArr);

    return $text;
}


function getCoctailData($coctail_name){

    $sql="SELECT * FROM `coctails` WHERE en_name = '{$coctail_name}'";
    $res = pdSql($sql, true);

    return $res;
}

function doDescr($text){
    global $coctail_name;
    $descr = $coctail_name." - ". $text;
    $subDescr = mb_substr($descr, 0, 170, 'UTF-8').'...';

    return $subDescr;
}


