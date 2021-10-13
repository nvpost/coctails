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

$process = 'tmp_data';
$text_info = $data['coctail_descr'];

$approve_status = 0;



$ings = json_decode($data['ing_rows'])->ings;
array_pop($ings);

$tools = json_decode($data['tools_rows'])->tools;
array_pop($tools);

$process = json_decode($data['process_rows'])->process;
array_pop($process);

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

$res = addToSql_coctail();


function addToSql_coctail(){
//    get last coctai id
    global $last_id;
    global $next_coctail_id;

    global $db;
    global $coctail_id;
    global $name;
    global $en_name;
    global $img_src;
    global $process;
    global $text_info;
    global $approve_status;
    global $user_id;



    $qwe = new SQLModelClass();
    $qwe -> table('coctails');
    $qwe -> select('coctail_id');
    $qwe -> where("1");
    $qwe -> orderBy(" coctail_id DESC");
    $qwe -> limit(1);


    $res = $qwe -> all();
    $last_id = (int)$res[0]['coctail_id'];
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

    return [$last_id, $next_coctail_id, $ex_data];
}
//'ext'=>$ext,
//    'target_file'=>$target_file,
//    'file'=>$file,

echo json_encode(['data' => $data,
    'res'=>$res,
    'img_src'=>$img_src,
    'ings'=>$ings,
    'tools'=>$tools,
    'process'=>$process,
    'tags'=>$tags]);



