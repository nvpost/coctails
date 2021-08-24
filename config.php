<?php
$home_url = "http://localhost/coctails/";
$db = new PDO('mysql:host=localhost;dbname=coctails_base;charset=UTF8', 'root', 'mysql');

$limit = 20;
$pagintation_step = 5;

echo "<script>
let home_url = '{$home_url}'
</script>";


$client_id = '7931364'; // ID приложения
$client_secret = 'E8dnvUiPCJ0iGruyj2vl'; // Защищённый ключ
$service_key = '666cf5ec666cf5ec666cf5ec656615f0086666c666cf5ec07735011b7149749b0dcfce1';
$redirect_uri = 'http://localhost/coctails/auth/vk.php'; // Адрес сайта

$vk_auth_url = 'http://oauth.vk.com/authorize';

$vk_auth_params = array(
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code'
);