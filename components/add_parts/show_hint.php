<?php

include "../../Classes/SQLModelClass.php";
require "../../func.php";


$fields=[
    'ingredient' => 'ingredients'
];

$data = json_decode(file_get_contents('php://input'));

$field = $data->field;
$table = $fields[$field];
$tag = $data->tag;


$qwe = new SQLModelClass();
$qwe -> table($table);
$qwe -> select('*');
$qwe -> where($field." LIKE '%".$tag."%'");
$qwe -> groupBy($field);
$res = $qwe -> all();

echo json_encode(['data' => $data, 'table' => $table, 'res' => $res]);
