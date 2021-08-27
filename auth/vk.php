
<?php

session_start();
require_once '../func.php';
require_once 'auth_data.php';


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

            if (isset($userInfo['response'][0]['id'])) {
                $userInfo = $userInfo['response'][0];
                $result = true;
            }
        }

        if ($result) {

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


            $set_user = checkUser($prepared_data);
        }

}

?>

