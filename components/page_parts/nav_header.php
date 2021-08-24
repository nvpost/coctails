<?php
session_start();
$user=false;
//drowLoginlineHtml =
if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
    $log_method = $_SESSION['log_method'];
    require_once 'auth/get_user.php';
}

function drowLoginline(){
    global $user;
    global $vk_auth_url;
    global $vk_auth_params;
    if($user){
        $user_bar_html = "<div class='user_bar'>";
        $user_bar_html .= "<div class='user_bar_img'>";
        $user_bar_html .= "<img src ='".$user['img']."'>";
        $user_bar_html .="</div>";
        $user_bar_html .= "<div class='user_bar_name'>";
        $user_bar_html .= "<p>".$user['login']."</p>";
        $user_bar_html .= "<p><a href='{$home_url}auth/exit.php'>Выход</a></p>";
        $user_bar_html .="</div>";
        $user_bar_html .="</div>";

        return $user_bar_html;
    }else{
        return "<p><a href='{$vk_auth_url}?". urldecode(http_build_query($vk_auth_params))."'>Войти vk</a> ";
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
