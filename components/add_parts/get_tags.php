<?php

include "../../Classes/SQLModelClass.php";
require "../../func.php";


$fields=[
    'ingredient' => 'ingredients',
    'name' => 'tools',
];




$qwe = new SQLModelClass();
$qwe -> select('*');
$qwe -> table('tags');
$res = $qwe -> all();



$new_res = [];
foreach ($res as $key => $val){
    $val['count'] = array_count_values(array_column($res, 'tag'))[$val['tag']];
    $val['field'] = 'tag';
    $val['origin_name'] = $val['tag'];

    $new_res[] = $val;

}
$flat_and_count = flatAndCount($new_res, "tag");
arsort($flat_and_count);

echo json_encode(['res' => $flat_and_count]);
