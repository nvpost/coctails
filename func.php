<?php

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


function cid($i){
    return $i['coctail_id'];
}
function getCoctailIds($arr){
    $res = array_map('cid', $arr);
    $res = array_unique($res);
    $res = implode(', ', $res);
    return $res;
}



function flatAndCount($arr, $key){
    $arr = array_column($arr, $key);
    $arr = array_count_values($arr);
    arsort($arr);
    return $arr;
}

function prepareUrl(){
    $s = $_SERVER['QUERY_STRING'];
    if(!$s){
        return false;
    }

    $queDataArr = explode('&', $s);

    $filters = [];
//    deb($queDataArr);
    foreach ($queDataArr as $que){
//        deb($que);
//        deb(strpos($que, 'age='));
        if(strpos($que, 'age=')){
            continue;
        }
        $filtersData = explode("=", $que);
        if(isset($filters[$filtersData[0]])){
            $unitedValue = $filters[$filtersData[0]].';'.$filtersData[1];
            $filters[$filtersData[0]] = $unitedValue;
        }else{
            $filters[$filtersData[0]] = $filtersData[1];
        }
    }

    return $filters;
}

function doRoute(){
    $routeUrl="";
    $routeArr = [];
    $getUrl = prepareUrl();
    if($getUrl){
        foreach ($getUrl as $key => $val){
            array_push($routeArr, "{$key}=$val");
        }
    }
    $routeUrl = implode("&",$routeArr);

    return $routeUrl;
}

function dooToolsContent($arr, $key, $filter){
    global $home_url;
    $filterArr = explode(";",$filter[$key]);
    $key = ($key=='name')?'tool':$key;
    foreach ($arr as $k =>$count){
        $label = trim($k);

        $partfOfUrl = doRoute($key);
        $href=($partfOfUrl) ? $home_url.$partfOfUrl.'&'.$key.'='.$label:$home_url.$key.'='.$label;
        $class = (in_array($label, $filterArr)) ? 'tags tags_active' : 'tags';
        $class = ($count<5)?  $class.' less_than_needed' : $class;
        echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $label)."&nbsp;(".$count.")</a> ";
    }
    //echo "<span class='show_less'>Показать все</span>";
}


$active_tag = $_GET['tag'];
$active_page = ($_GET['page'])?". Страница - ".$_GET['page']:false;

$active_ingredient = $_GET['ingredient'];

$filters = prepareUrl();

