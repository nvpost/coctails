<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
$data = json_decode(file_get_contents('php://input'));



$db = new PDO('mysql:host=localhost;dbname=coctails_base;charset=UTF8', 'root', 'mysql');

$user_id  = isset($_SESSION['user'])?$_SESSION['user']['id']:'no_auth';
$coctail_id = $data->coctail_id;

$check_rating_data = false;

if($user_id!='no_auth'){
    $check_rating_sql = "SELECT * from rating where coctail_id='{$coctail_id}' AND user_id='{$user_id}'";
    $check_rating_res = $db->prepare($check_rating_sql);
    $check_rating_res->execute();
    $check_rating_data = $check_rating_res->fetch(PDO::FETCH_ASSOC);
}


if($check_rating_data){
    $data = [
        'rating' => $data->n,
        'coctail_id' => $coctail_id
    ];
    $update_sql = "UPDATE rating SET rating=:rating WHERE coctail_id=:coctail_id";
    $update_res= $db->prepare($update_sql);
    $update_res->execute($data);
}
else{
    $rating_values = [
        'user_id' => $user_id,
        'coctail_id' => $coctail_id,
        'rating' => $data->n
    ];

    $sql = "INSERT INTO rating (user_id, coctail_id, rating)
    VALUES (:user_id, :coctail_id, :rating)";

    $statement = $db->prepare($sql);
    $statement->execute($rating_values);
}




echo json_encode([ 'check_rating_data'=>$check_rating_data, 'rating_values'=>$rating_values]);




?>