<?php


$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();


if($filters){
    $unionIds=array();
    foreach ($filters as $table => $val){
        $val = explode(';', $val);
        foreach ($val as $v){
            if($table == 'tag'){
                $where = "tags.tag = '".$v."'";
            }
            if($table == 'ingredient'){
                $where = "ingredients.ingredient = '".$v."'";
            }
            if($table == 'tool'){
                $where = "tools.name = '".$v."'";
            }

            $sql = "SELECT DISTINCT coctails.coctail_id  FROM coctails, {$table}s
                          WHERE {$where}
                          AND coctails.coctail_id = {$table}s.coctail_id";

            $flat_c_ids = pdSql($sql);
            $flat_c_ids = array_column($flat_c_ids, 'coctail_id');
            $unionIds = (count($unionIds)==0) ? $flat_c_ids : array_intersect($unionIds, $flat_c_ids);
        }
    }



    $coctail_id = "'" .implode("', '", $unionIds) ."'";
    deb(count($unionIds));


}
$allCoctailsWhere = ($unionIds)?" coctail_id IN(".$coctail_id.")" : 1;


$countCoctails = $countCoctailsClass->table('coctails')
    ->select('*')
    ->where($allCoctailsWhere)
    ->count();


$allCoctails = $sqlClass->table('coctails')
    ->select("*")
    ->limit($set_limit)
    ->where($allCoctailsWhere)
    ->all();


$catalogHtml = new CatalogWidgetClass($allCoctails);

$catalog = $catalogHtml->getCatalogItem();


require_once 'components/catalogWidget.php';

echo "<div class='pagination'>";
//    deb($countCoctails);
    drowPagination($countCoctails);

echo "</div>";