<?php

//session_start();
$user_id = 18;


include "../../Classes/SQLModelClass.php";
require "../../func.php";

$data = $_POST;




$res = '';
$name = $data['coctail_label'];
$en_name = $data['coctail_label_en'];
$img_src = saveImg();

//$process = 'tmp_data';
$text_info = $data['coctail_descr'];

$approve_status = 0;



$ings = json_decode($data['ing_rows'])->ings;
array_pop($ings);

$tools = json_decode($data['tools_rows'])->tools;
array_pop($tools);

$process_arr = json_decode($data['process_rows'])->process;
array_pop($process_arr);
$tmp_process_arr = [];
foreach ($process_arr as $p){
    $tmp_process_arr[] = $p->process_row;
}
//$process =

$process = implode("; ", $tmp_process_arr);

$tags = json_decode($data['tag_list'])->tags;


function addToBase(){

    addToSql_coctail($img_src); //coctail_id
    addToSql_ing();
    addToSql_tools();
    addToSql_tags();
    addToSql_img();
}

function saveImg(){
    global $data;

    $file = $_FILES['img'];
    $file_name = $file['name'];
    $coctail_img_name = $data['coctail_label_en'];
    $file_name_arr = explode('.', $file_name);
    $ext = array_pop($file_name_arr);
    $img_src = $coctail_img_name.".".$ext;
    $target_file = "../../tmp_img/{$coctail_img_name}.{$ext}";
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

    return $img_src;
}



$insert_coctail_data = addToSql_coctail();


function addToSql_coctail(){
    global $last_id;
    global $next_coctail_id;

    global $db;
    global $name;
    global $en_name;
    global $img_src;
    global $process;
    global $text_info;
    global $approve_status;
    global $user_id;


    $sql = "SELECT coctail_id FROM coctails WHERE 1 ORDER BY coctail_id DESC LIMIT 1";
    $res = $db->prepare($sql);
    $res->execute();
    $data = $res->fetch(PDO::FETCH_ASSOC);
    $last_id = $data['coctail_id'];

    $next_coctail_id = $last_id+1;

    $ex_data=[
        $next_coctail_id,
        $name,
        $en_name,
        $img_src,
        $process,
        $text_info,
        $approve_status,
        $user_id,
    ];




    $sql = "INSERT INTO coctails (coctail_id, name, en_name, src, process, text_info, approve_status, user_id)
        VALUES (?,?,?,?,?,?,?,?)";
    $stmt= $db->prepare($sql);
    $stmt->execute($ex_data);






    return ['next_coctail_id'=>$next_coctail_id, 'ex_data'=>$ex_data];

//    return $data;
}

$add_ing = addToSql_ing();

function addToSql_ing(){
    global $insert_coctail_data;
    global $ings;
    global $db;

    $coctail_id = $insert_coctail_data['next_coctail_id'];
    $res = $coctail_id;
    foreach ($ings as $ing){

        $sql = "INSERT INTO ingredients (coctail_id, ingredient, amount, unit) VALUES (?,?,?,?)";
        $res = $db->prepare($sql);
        $res->execute([
            $coctail_id,
            checkQoery($ing->ingredient),
            checkQoery($ing->amount),
            checkQoery($ing->unit)
        ]);
    }
    return $res;
}

$add_tools = addToSql_tools();

function addToSql_tools(){
    global $insert_coctail_data;
    global $tools;
    global $db;

    $coctail_id = $insert_coctail_data['next_coctail_id'];
    $res = $coctail_id;
    foreach ($tools as $tool){

        $sql = "INSERT INTO tools (coctail_id, name, amount, unit) VALUES (?,?,?,?)";
        $res = $db->prepare($sql);
        $res->execute([
            $coctail_id,
            checkQoery($tool->name),
            checkQoery($tool->amount),
            checkQoery($tool->unit)
        ]);
    }
    return $res;
}

$add_tags = addToSql_tags();

function addToSql_tags(){
    global $insert_coctail_data;
    global $tags;
    global $db;

    $coctail_id = $insert_coctail_data['next_coctail_id'];
    $res = $coctail_id;
    foreach ($tags as $tag){

        $sql = "INSERT INTO tags (coctail_id, tag) VALUES (?,?)";
        $res = $db->prepare($sql);
        $res->execute([
            $coctail_id,
            checkQoery($tag),
        ]);
    }
    return $res;
}

function checkQoery($s){
    return $s;
}


//TODO Проверка на момент отправки

echo json_encode(['data' => $data,
    'add_ing'=>$add_ing,
    'res'=>$insert_coctail_data,
    'img_src'=>$img_src,
    'ings'=>$ings,
    'tools'=>$tools,
    'process'=>$process,
    'tags'=>$tags]);



