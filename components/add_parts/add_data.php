<?php

//$data = json_decode(file_get_contents('php://input'));

$data = $_POST;


$file = $_FILES['img'];
$temp = $file['img']['tmp_name'];
$file_name = $file['img']['name'];
$target_file = '../../tmp_img/targetfilename111.jpg';
move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

$ings = json_decode($data['ing_rows'])->ings;
array_pop($ings);

$tools = json_decode($data['tools_rows'])->tools;
array_pop($tools);

$process = json_decode($data['process_rows'])->process;
array_pop($process);

$tags = json_decode($data['tag_list'])->tags;


echo json_encode(['data' => $data,
    'file'=>$_FILES,
    'ings'=>$ings,
    'tools'=>$tools,
    'process'=>$process,
    'tags'=>$tags]);
