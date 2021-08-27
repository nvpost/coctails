<?php
require_once '../func.php';

require_once 'auth_data.php';


if (isset($_GET['code'])) {
    $result = false;

    $params = array(
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'client_id'     => $ya_client_id,
        'client_secret' => $ya_client_secret
    );

    $ya_url = 'https://oauth.yandex.ru/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $ya_url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $params = array(
            'format'       => 'json',
            'oauth_token'  => $tokenInfo['access_token']
        );

        $userInfo = json_decode(file_get_contents('https://login.yandex.ru/info' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }

    if ($result) {
//        echo "<pre>";
//        print_r($userInfo);
//        echo "</pre>";

        $pre_img = 'https://avatars.yandex.net/get-yapic/';
        $img_size = 'islands-retina-small';

        require_once 'check_add_user.php';

        $method = 'ya';
        $prepared_data=[
            "login" => $userInfo['login'],
            "pass_hash" => '',
            "user_name" => $userInfo['display_name'],
            "method" => $method,
            "img" => $userInfo['default_avatar_id'],
            "email" => $userInfo['default_email'],
            "uid" => $userInfo['id'].'_'.$method,
            "status" =>'user'
        ];



        $set_user = checkUser($prepared_data);
        if($set_user){
            header("Location: {$home_url}");
        }

    }
}