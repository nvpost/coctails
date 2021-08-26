<?php


function loginBar(){
    global $vk_auth_url;
    global $vk_auth_params;
    global $ya_url;
    global $ya_params;
    global $google_url;
    global $google_params;


    $login_bar = "<div class='login_bar'>";
    $login_bar .="<div class='enter_hamburger' onclick='auth_modal()'>
            <p>Войти <i class='fas fa-bars'></i></p>
            </div>";

    $js_vk_auth_url = $vk_auth_url."?". urldecode(http_build_query($vk_auth_params));
    $js_ya_auth_url = $ya_url."?" . urldecode(http_build_query($ya_params));
    $js_ga_auth_url = $google_url."?" . urldecode(http_build_query($google_params));

    echo "<script>
    let auth_urls = [
        {'label': 'Войти через VK', 'fa':'fab fa-vk', 'link':'{$js_vk_auth_url}'},
        {'label': 'Войти через Яндекс', 'fa':'fab fa-yandex', 'link':'{$js_ya_auth_url}'},
        {'label': 'Войти через google', 'fa':'fab fa-google', 'link':'{$js_ga_auth_url}'}
    ]


    </script>";

//    $login_bar .= "<div class='login_bar_dropdown'>";
//        $login_bar .= "<p><a href='{$vk_auth_url}?". urldecode(http_build_query($vk_auth_params))."'>Войти vk</a></p>";
//        $login_bar .= "<p><a href='{$ya_url}?" . urldecode(http_build_query($ya_params)) . "'>Войти через Yandex</a></p>";
//        $login_bar .= "<p><a href='{$google_url}?" . urldecode(http_build_query($google_params)) . "'>Войти через Google</a></p>";
//    $login_bar .= "</div>";

    $login_bar .= "</div>";


    return $login_bar;
}


function userBar(){
    global $user;
    global $home_url;
    $user_bar_html = "<div class='user_bar'>";
    $user_bar_html .= "<div class='user_bar_img'>";
    $user_bar_html .= "<img src ='".$user['img']."'>";
    $user_bar_html .="</div>";
    $user_bar_html .= "<div class='user_bar_name'>";
    $user_bar_html .= "<p>".$user['user_name']."</p>";
    $user_bar_html .= "<p><a href='{$home_url}auth/exit.php'>Выход</a></p>";
    $user_bar_html .="</div>";
    $user_bar_html .="</div>";

    return $user_bar_html;
}
