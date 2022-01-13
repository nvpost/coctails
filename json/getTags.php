<?php

require "../func.php";



$sql = "SELECT *  FROM ingredients WHERE 1 ";

$tags = pdSql($sql);
//deb($tags);
foreach ($tags as $tag){
    $t = trim($tag['ingredient']);
    $t = str_replace('"', '', $t);
    $t = str_replace("'", "", $t);
   echo "{'id':'".$tag['id']."', 'coctail_id':'".$tag['coctail_id']."', 'ingredient':'".$t."'},";
}
//$flat_c_ids = array_column($flat_c_ids, 'coctail_id');
