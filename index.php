<?php

require_once 'config.php';

//session_destroy();


spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

$t = new TimeLogClass('app');

require_once 'func.php';


$page = 0;
if(isset($_GET['page'])){
    $page = $_GET['page']-1;
}


?>
<head>
<link href="<?=$home_url?>assets/css.css" rel="stylesheet">
        <?php
            require_once 'components/page_meta.php';
        ?>

<!--<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"  type="application/javascript"></script>-->
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://unpkg.com/vue-multiselect@2.1.0" type="application/javascript"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">-->
</head>

<body>
<script>
    let value_tag, value_name, value_ingredient=[]
    var arr_tag, arr_name, arr_ingredient=[]
</script>

<div class="app_container" id="coctail_app">
    <div class="hover" onclick="closeModal()"></div>


<?php


require_once 'components/page_parts/nav_header.php';

echo "<div class='page_container'>";

if($filters&&!isset($filters['coctail'])){
    require_once 'components/activeTags.php';
}

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


?>
</div>
</div>

<script>
    let home_url = '<?=$home_url?>'
</script>

</body>
<?php
c_deb($sql_count);
$t->relatedTimeStop('server');
?>

    <script src="<?=$home_url?>assets/vue_select.js" type="application/javascript"></script>
    <script src="<?=$home_url?>assets/js.js"></script>

