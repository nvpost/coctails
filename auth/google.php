<?php
require_once '../func.php';

require_once 'auth_data.php';


if (isset($_GET['code'])) {
    $result = false;

    $params = array(
        'client_id'     => $google_client_id,
        'client_secret' => $google_secret,
        'redirect_uri'  => $google_redirect_uri,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code']
    );

    $url = 'https://accounts.google.com/o/oauth2/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = json_decode($result, true);

    if (isset($tokenInfo['access_token'])) {
        $params['access_token'] = $tokenInfo['access_token'];

        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }

    if ($result) {
        echo "<pre>";
        print_r($userInfo);
        echo "</pre>";
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
        echo "Имя пользователя: " . $userInfo['name'] . '<br />';
        echo "Email: " . $userInfo['email'] . '<br />';
        echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
        echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
        echo '<img src="' . $userInfo['picture'] . '" />'; echo "<br />";

        require_once 'check_add_user.php';

        $method = 'google';
        $prepared_data=[
            "login" => $userInfo['given_name'],
            "pass_hash" => '',
            "user_name" => $userInfo['given_name'],
            "method" => $method,
            "img" => $userInfo['picture'],
            "email" => "",
            "uid" => $userInfo['id'].'_'.$method,
            "status" =>'user'
        ];

//        deb($prepared_data);
        $set_user = checkUser($prepared_data);

    }

}