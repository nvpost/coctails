<?php
session_start();
$user=false;
require_once '/auth/auth_data.php';

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}

require_once "header_parts/login_bar.php";
function drowLoginline(){
    global $user;
    if($user){
        $user_bar_html = userBar();
        return $user_bar_html;
    }else{
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
    <div class="user">

        <?=drowLoginline()?>
    </div>
</div>
</div>
