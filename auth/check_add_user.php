<?php

session_start();
function checkUser($userInfo){
    if($userInfo['method']=='vk'){
        $sql = "select * from users where uid = {$userInfo['id']}";
    }
    $user = pdSql($sql);
    if($user){
        echo "Пользователь есть";
        $_SESSION['uid'] = $userInfo['id'];
        $_SESSION['log_method'] = $userInfo['method'];
        return true;
    }else{
        echo "Пользователя нет, добавляем в базу";
        return addUserToBase($userInfo);
    }


}

function addUserToBase($userInfo){
    global $db;
    deb($db);

    $sql = "INSERT INTO users (login, pass_hash, user_name, method, img, uid, status)
            VALUES (:login, :pass_hash, :user_name, :method, :img, :uid, :status)";

    try{
        $sql_data=[
            'login'=>$userInfo['first_name'],
            'pass_hash'=>'',
            'user_name'=>$userInfo['screen_name'],
            'method'=>'vk',
            'img'=>$userInfo['photo_big'],
            'uid'=>$userInfo['id'],
            'status'=>'user'
        ];
        $statement = $db->prepare($sql);
        $statement->execute($sql_data);
        deb($sql_data);
        deb('Запись прошла');
        $_SESSION['uid'] =$userInfo['id'];
        $_SESSION['log_method'] = $userInfo['method'];

        return true;
    }catch (Exception $err) {
        print_r($err);
    }
    deb($statement);
}

//$_SESSION['uid'] = md5($userInfo['id']);