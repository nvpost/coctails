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
    foreach ($queDataArr as $que){
        if(strpos($que, 'age=')){ //Проверка на страницу
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

$filters = prepareUrl();

function doRoute(){
    global $filters;
    $routeArr = [];
    $getUrl = $filters; //filters
    if($getUrl){
        foreach ($getUrl as $key => $val){
            $routeArr[$key]=$val;
        }
    }
    return $routeArr;
}

function dooToolsContent($arr, $key, $filter){
    global $home_url;
    $filterArr = explode(";",$filter[$key]);
    $key = ($key=='name')?'tool':$key;

    foreach ($arr as $k =>$count){
        $label = trim($k);

        $partsfOfUrl = doRoute();
        if(isset($partsfOfUrl[$key])&&(strpos($partsfOfUrl[$key], $label)===False)){
            $partsfOfUrl[$key] = $partsfOfUrl[$key].";{$label}";
        }else{
            $partsfOfUrl[$key] = $label;
        }

        $rows = [];
        foreach ($partsfOfUrl as $cat => $value){
            $rows[] = "{$cat}={$value}";
        }
        $href = $home_url.implode("&",$rows);

        $class = (in_array($label, $filterArr)) ? 'tags tags_active' : 'tags';
        $class = ($count<5)?  $class.' less_than_needed' : $class;
        echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $label)."&nbsp;(".$count.")</a> ";
    }
}


$active_page = ($_GET['page'])?". Страница - ".$_GET['page']:false;




