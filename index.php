<?php

require_once 'config.php';
echo "<script>
let home_url = '{$home_url}'
</script>";
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

$t = new TimeLogClass('app')
?>

<link href="<?=$home_url?>assets/css.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">-->

<div class="app_container">
<?php

require_once 'func.php';


$page = 0;
if(isset($_GET['page'])){
    $page = $_GET['page']-1;
//    deb($page);
}

if($filters&&!isset($filters['coctail'])){
    require_once 'components/activeTags.php';
}

$page_tags = [];



require_once 'components/pagination.php';



if(isset($_GET['coctail'])){
    require_once "pages/coctail_page.php";
}
else if(isset($_GET['tools'])){
    require_once "pages/tools_page.php";
    require_once 'components/requireBlocks.php';
}
else if(isset($_GET['ingredient'])){
    require_once "pages/ingredient_page.php";
    require_once 'components/requireBlocks.php';
}
else if(isset($_GET['tag'])){
    require_once "pages/tag_page.php";
    require_once 'components/requireBlocks.php';
}
else{
    require_once 'components/requireBlocks.php';
}

$t->timerStop();
?>

    <script src="<?=$home_url?>assets/js.js"></script>

