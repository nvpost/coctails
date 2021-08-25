<?php

session_start();


function checkUser($userInfo){
    //if($userInfo['method']=='vk'){
        $sql = "select * from users where uid='{$userInfo['uid']}'";
    //}
    $user = pdSql($sql);
    if($user){
        echo "Пользователь есть";
        loginUser($userInfo);
    }else{
        echo "Пользователя нет, добавляем в базу";
        addUserToBase($userInfo);
    }


}

function addUserToBase($userInfo){
    global $db;
    deb($db);

    $sql = "INSERT INTO users (login, pass_hash, user_name, method, img, email, uid, status)
            VALUES (:login, :pass_hash, :user_name, :method, :img, :email, :uid, :status)";

    try{
        $statement = $db->prepare($sql);
        $statement->execute($userInfo);
//        deb($userInfo);
//        deb('Запись прошла');
        loginUser($userInfo);

        return true;
    }catch (Exception $err) {
        print_r($err);
    }
}


function loginUser($userInfo){
    global $home_url;
    deb($userInfo);
    $_SESSION['uid'] = $userInfo['uid'];
    header("Location: {$home_url}");
}
