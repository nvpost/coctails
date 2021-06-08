<link href="<?=$home_url?>assets/css.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<?php
$home_url = "http://localhost/coctails/";

require_once 'sql/sql.php';
require_once 'func.php';




if(isset($_GET['tag'])){
    require_once "pages/tag_page.php";
}else{
    require_once "pages/main.php";
}

//echo "<h2>Категории</h2>";
//require_once 'components/tags.php';

//echo "<h2>Ингредиенты</h2>";
//require_once 'components/ingredients.php';

//$coctailsClass = new CoctailsClass();
//$coctails = $coctailsClass->getCoctails();
//deb($coctails)

?>

