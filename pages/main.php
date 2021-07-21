<?php





//deb($page);




$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

if($_GET['tag']){
    $active_tag = $_GET['tag'];

    $table = 'coctails, tags';
    $select = 'coctails.*, tags.*';
    $where = "tags.tag='".$active_tag."' AND tags.coctail_id = coctails.coctail_id";
}

else{
    $table = 'coctails';
    $select = '*';
    $where = 1;
}


$allCoctails = $sqlClass->table($table)
    ->select($select)
    ->limit($set_limit)
    ->where($where)
    ->all();

//deb($set_limit);
$countCoctails = $countCoctailsClass->table('coctails')
    ->select('*')
    ->where(1)
    ->count();


$catalogHtml = new CatalogWidgetClass($allCoctails);





$catalog = $catalogHtml->getCatalogItem();
require_once 'components/catalogWidget.php';

echo "<div class='pagination'>";
//    deb($countCoctails);
    drowPagination($countCoctails);
echo "</div>";