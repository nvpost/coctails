<?php

require_once 'sql/sql.php';
function deb($v, $h=0){
    if($h) echo "<hr>";
    echo "<pre>";
    print_r($v);
    echo "</pre>";
    if($h) echo "<hr>";
}
function c_deb($v){
    echo "<script>";
    echo "console.log('".$v."')";
    echo "</script>";
}

function pdSql($sql, $one=false){
    global $sql_count;
    global $db;
    $res = $db->prepare($sql);
    $res->execute();
    if($one){
        $data = $res->fetch(PDO::FETCH_ASSOC);
    }else{
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
    }

    $sql_count++;

    return($data);

}

require_once 'config.php';