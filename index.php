<?php
$home_url = "http://localhost/coctails/";
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

?>

<link href="<?=$home_url?>assets/css.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<?php


//require_once 'sql/sql.php';
require_once 'func.php';
require_once 'components/pagination.php';

$page = 0;
if(isset($_GET['page'])){
    $page = $_GET['page']-1;
}

if(isset($_GET['tag'])){
    require_once "pages/tag_page.php";
}
else{

    require_once "pages/main.php";
}


?>

