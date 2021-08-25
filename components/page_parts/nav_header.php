<?php
session_start();
$user=false;
require_once '/auth/auth_data.php';
if(isset($_SESSION['uid'])){
//    deb($_SESSION);
    $uid = $_SESSION['uid'];

    $sql = "select * from users where uid='{$uid}'";
    $user = pdSql($sql)[0];
//    deb($sql);
//    deb($user);
}

function drowLoginline(){
    global $user;
    global $vk_auth_url;
    global $vk_auth_params;
    global $ya_url;
    global $ya_params;
    global $google_url;
    global $google_params;

    if($user){
        $user_bar_html = "<div class='user_bar'>";
        $user_bar_html .= "<div class='user_bar_img'>";
        $user_bar_html .= "<img src ='".userPicSrc($user)."'>";
        $user_bar_html .="</div>";
        $user_bar_html .= "<div class='user_bar_name'>";
        $user_bar_html .= "<p>".$user['user_name']."</p>";
        $user_bar_html .= "<p><a href='{$home_url}auth/exit.php'>Выход</a></p>";
        $user_bar_html .="</div>";
        $user_bar_html .="</div>";

        return $user_bar_html;
    }else{
        $login_bar = "<div class='login_bar'>";
        $login_bar .= "<p><a href='{$vk_auth_url}?". urldecode(http_build_query($vk_auth_params))."'>Войти vk</a></p>";
        $login_bar .= "<p><a href='{$ya_url}?" . urldecode(http_build_query($ya_params)) . "'>Войти через Yandex</a></p>";
        $login_bar .= "<p><a href='{$google_url}?" . urldecode(http_build_query($google_params)) . "'>Войти через Google</a></p>";


        $login_bar .= "</div>";
        return $login_bar;
    }
}

function userPicSrc($user){
    if($user['method']=='ya'){
        return "https://avatars.yandex.net/get-yapic/".$user['img']."/islands-retina-small ";
    }else{
        return $user['img'];
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
