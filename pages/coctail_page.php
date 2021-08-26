
<?php

$coctail_name = $_GET['coctail'];


$sqlClass = new SQLModelClass();
$countCoctailsClass = new SQLModelClass();

$coctail = $sqlClass->table("coctails")
    ->select("*")
    ->where("coctails.en_name='".$coctail_name."'")
    ->one();

$process = explode("; ", $coctail['process']);


$coctail_tags = $sqlClass->table("tags")
    ->select("*")
    ->where("tags.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_tags);


$coctail_tools = $sqlClass->table("tools")
    ->select("*")
    ->where("tools.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_tools);

$coctail_ingredients = $sqlClass->table("ingredients")
    ->select("*")
    ->where("ingredients.coctail_id='".$coctail['coctail_id']."'")
    ->all();
//deb($coctail_ingredients);
$coctail_rating_data = $sqlClass->table("rating")
    ->select("*")
    ->where("rating.coctail_id='".$coctail['coctail_id']."'")
    ->all();
if($coctail_rating_data){
    // deb($coctail_rating_data);
    $count_of_rate = count($coctail_rating_data);
    $all_rate = array_sum(array_column($coctail_rating_data, 'rating'));

    $coctail_rating = round($all_rate/$count_of_rate, 1);
    // deb('count_of_rate '.$count_of_rate);
    // deb('all_rate '. $all_rate);
    // deb('coctail_rating '. $coctail_rating);
}




echo "<script>
    let coctail_id = {$coctail['coctail_id']};
</script>";
require_once 'components/coctailPageWidget.php';
