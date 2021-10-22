<?php
session_start();
$user=false;
require_once 'auth/auth_data.php';
require_once "header_parts/add_button.php";
require_once "header_parts/login_bar.php";

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    //deb($user);
}


function drowLoginline(){
    global $user;

    if($user){
        $user_bar_html = userBar();
        return $user_bar_html;
    }else{
        require_once "header_parts/login_bar.php";
        $login_bar = loginBar();
        return $login_bar;
    }
}


?>


<div class="header_wrapper">
<div class="header_container container">
    <div class="header_home">
        <a href="<?=$home_url;?>">Главная</a>
    </div>
<!--    --><?//=addBotton() ?>
    <div class="user">

        <?=drowLoginline()?>
    </div>
</div>
</div>
