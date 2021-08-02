<?php


$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

if($_GET['tag']){
    $active_tag = $_GET['tag'];
    $table = 'coctails, tags';
    $select = 'coctails.*, tags.*';
    $where = "tags.tag='".$active_tag."' AND tags.coctail_id = coctails.coctail_id";
}

else if($_GET['tools']){
    $active_tool = $_GET['tools'];
    $table = 'coctails, tools';
    $select = 'coctails.*, tools.coctail_id, tools.name as tool_name';
    $where = "tools.name='".$active_tool."' AND tools.coctail_id = coctails.coctail_id";
}

else if($_GET['ingredient']){
    $active_tool = $_GET['ingredient'];
    $table = 'coctails, ingredients';
    $select = 'coctails.*, ingredients.*';
    $where = "ingredients.ingredient='".$active_tool."' AND ingredients.coctail_id = coctails.coctail_id";
}

else{
    $table = 'coctails';
    $select = '*';
    $where = 1;
}

$countCoctails = $countCoctailsClass->table($table)
    ->select('*')
    ->where($where)
    ->count();

$allCoctails = $sqlClass->table($table)
    ->select($select)
    ->limit($set_limit)
    ->where($where)
    ->all();


//deb($countCoctails);


$catalogHtml = new CatalogWidgetClass($allCoctails);

$catalog = $catalogHtml->getCatalogItem();


require_once 'components/catalogWidget.php';

echo "<div class='pagination'>";
//    deb($countCoctails);
    drowPagination($countCoctails);

echo "</div>";