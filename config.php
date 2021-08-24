<?php
$home_url = "http://localhost/coctails/";
$db = new PDO('mysql:host=localhost;dbname=coctails_base;charset=UTF8', 'root', 'mysql');

$limit = 20;
$pagintation_step = 5;

echo "<script>
let home_url = '{$home_url}'
</script>";




$vk_auth_url = 'http://oauth.vk.com/authorize';

$vk_auth_params = array(
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code'
);