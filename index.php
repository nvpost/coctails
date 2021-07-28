<?php
$home_url = "http://localhost/coctails/";
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

?>

<link href="<?=$home_url?>assets/css.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<!--<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">-->

<div class="app_container">
<?php


//require_once 'sql/sql.php';

$page = 0;
if(isset($_GET['page'])){
    $page = $_GET['page']-1;
}

$page_tags = [];
if(isset($_GET['tag'])){
    $active_tag = $_GET['tag'];
    foreach (explode(",",$_GET['tag']) as $item){
        array_push($page_tags, $item);
    }
}


require_once 'func.php';
require_once 'components/pagination.php';



if(isset($_GET['coctail'])){
    require_once "pages/coctail_page.php";
}
else if(isset($_GET['tools'])){
    require_once "pages/tools_page.php";
    require_once "pages/main.php";
}
else if(isset($_GET['ingredient'])){
    require_once "pages/ingredient_page.php";
    require_once "pages/main.php";
}
else if(isset($_GET['tag'])){
    require_once "pages/tag_page.php";
    require_once "pages/main.php";
}
else{
    require_once 'components/tags.php';
    require_once "pages/main.php";
}


?>

