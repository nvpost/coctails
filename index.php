<link href="<?=$home_url?>assets/css.css" rel="stylesheet">
<?php
$home_url = "http://localhost/coctails/";

require_once 'sql/sql.php';
require_once 'func.php';




spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});


if(isset($_GET['tag'])){
    require_once "pages/tag_page.php";
}

echo "<h2>Категории</h2>";
require_once 'components/tags.php';

//echo "<h2>Ингредиенты</h2>";
//require_once 'components/ingredients.php';

//$coctailsClass = new CoctailsClass();
//$coctails = $coctailsClass->getCoctails();
//deb($coctails)

?>

