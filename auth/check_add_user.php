<?php

session_start();


function checkUser($userInfo){
    //if($userInfo['method']=='vk'){
        $sql = "select * from users where uid='{$userInfo['uid']}'";
    //}
    $user = pdSql($sql);
    if($user){
//        echo "Пользователь есть";
        //deb($user[0]);
        loginUser($user[0]);
    }else{
//        echo "Пользователя нет, добавляем в базу";
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
        $userInfo['id'] = $db->lastInsertId();
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
//    deb($userInfo);
    $img_src = ($userInfo['method']=='ya')?
        "https://avatars.yandex.net/get-yapic/".$userInfo['img']."/islands-retina-small":
        $userInfo['img'];
    $user = [
        'uid'=>$userInfo['uid'],
        'user_name'=>$userInfo['user_name'],
        'img'=>$img_src,
        'id'=>$userInfo['id']
    ];
    $_SESSION['user'] = $user;

    header("Location: {$home_url}");
}
