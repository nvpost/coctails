<?php

include "../../Classes/SQLModelClass.php";
require "../../func.php";


$fields=[
    'ingredient' => 'ingredients',
    'name' => 'tools',
];

$data = json_decode(file_get_contents('php://input'));

$field = $data->field;
$table = $fields[$field];
$tag = $data->tag;


$qwe = new SQLModelClass();
$qwe -> select('*');
$qwe -> table($table);
$qwe -> where($field." LIKE '%".$tag."%'");
//$qwe -> groupBy($field);
$res = $qwe -> all();

$new_res = [];
foreach ($res as $key => $val){
    $val['count'] = array_count_values(array_column($res, $field))[$val[$field]];
    $val['field'] = $field;
    $val['origin_name'] = $val[$field];

    $new_res[] = $val;

}
$flat_and_count = flatAndCount($new_res, $field);
arsort($flat_and_count);



echo json_encode(['data' => $data, 'table' => $table, 'res' => $flat_and_count]);
