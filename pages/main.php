<?php


$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

//deb($fiters);
//Забрать sql из ToolsClass

//if($_GET['tag']){
//    $active_tag = $_GET['tag'];
//    $table = 'coctails, tags';
//    $select = 'coctails.*, tags.*';
//    deb($active_tag);
//    $where = "tags.tag='".$active_tag."' AND tags.coctail_id = coctails.coctail_id";
//}
//
//else if($_GET['tools']){
//    $active_tool = $_GET['tools'];
//    $table = 'coctails, tools';
//    $select = 'coctails.*, tools.coctail_id, tools.name as tool_name';
//    $where = "tools.name='".$active_tool."' AND tools.coctail_id = coctails.coctail_id";
//}
//
//else if($_GET['ingredient']){
//    $active_tool = $_GET['ingredient'];
//    $table = 'coctails, ingredients';
//    $select = 'coctails.*, ingredients.*';
//    $where = "ingredients.ingredient='".$active_tool."' AND ingredients.coctail_id = coctails.coctail_id";
//}
//
//else{
//    $table = 'coctails';
//    $select = '*';
//    $where = 1;
//}
//
//$countCoctails = $countCoctailsClass->table($table)
//    ->select('*')
//    ->where($where)
//    ->count();
//
//$allCoctails = $sqlClass->table($table)
//    ->select($select)
//    ->limit($set_limit)
//    ->where($where)
//    ->all();

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