<?php

include "../../Classes/SQLModelClass.php";
require "../../func.php";

$data = $_POST;



$img_src="";



$ings = json_decode($data['ing_rows'])->ings;
array_pop($ings);

$tools = json_decode($data['tools_rows'])->tools;
array_pop($tools);

$process = json_decode($data['process_rows'])->process;
array_pop($process);

$tags = json_decode($data['tag_list'])->tags;


function addToBase(){
    saveImg();
    addToSql_coctail(); //coctail_id
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
}


echo json_encode(['data' => $data,
    'ext'=>$ext,
    'target_file'=>$target_file,
    'file'=>$file,
    'ings'=>$ings,
    'tools'=>$tools,
    'process'=>$process,
    'tags'=>$tags]);



