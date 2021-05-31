<?php
require_once 'sql/sql.php';
require_once 'func.php';

$home_url = $_SERVER['HTTP_REFERER'];


spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});


if(isset($_GET['tag'])){
    require_once "pages/tag_page.php";
}






require_once 'components/tags.php';

?>
<link href="<?=$home_url?>assets/css.css" rel="stylesheet">
