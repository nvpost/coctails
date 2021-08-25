
<?php

session_start();
require_once '../func.php';
//require_once '../config.php';
require_once 'auth_data.php';
if($_SESSION['uid11']) {
    if(isset($_GET['exit'])){
        session_destroy();
        header("Location:http://localhost/coctails/auth/vk.php");
    }
      print_r($_SESSION['uid']);

      echo "<br><a href='?exit=exit'>Выход</a>";
}else {



    if (isset($_GET['code'])) {
        $result = false;
        $params = array(
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $_GET['code'],
            'redirect_uri' => $redirect_uri
        );
        $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
        if (isset($token['access_token'])) {
            $params = array(
                'uids' => $token['user_id'],
                'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
                'access_token' => $token['access_token'],
                'v' => '5.103'
            );

            $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
            echo "<pre>";
            print_r($userInfo);
            echo "</pre>";
            if (isset($userInfo['response'][0]['id'])) {
                $userInfo = $userInfo['response'][0];
                $result = true;
            }
        }

        if ($result) {
            echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
            echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
            echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
            echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
            echo "День Рождения: " . $userInfo['bdate'] . '<br />';
            echo '<img src="' . $userInfo['photo_big'] . '" />';
            echo "<br />";
            require_once 'check_add_user.php';

            $method = 'vk';
            $prepared_data=[
                "login" => $userInfo['screen_name'],
                "pass_hash" => '',
                "user_name" => $userInfo['first_name'],
                "method" => $method,
                "img" => $userInfo['photo_big'],
                "email" => "",
                "uid" => $userInfo['id'].'_'.$method,
                "status" =>'user'
            ];

            deb($prepared_data);
            $set_user = checkUser($prepared_data);
//            if($set_user){
//                $_SESSION['uid'] = $userInfo['id'];
//                $_SESSION['log_method'] = $userInfo['method'];
//                header("Location: {$home_url}");
//            }


        } else {
            echo "Нет авторизации";
        }
    }
}

?>

