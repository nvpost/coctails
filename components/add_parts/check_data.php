<?php




include "../../Classes/SQLModelClass.php";
require "../../func.php";

//TODO Нужна проверка на статус
$fields=[
    'coctail_label' => 'coctails'
];

$data = json_decode(file_get_contents('php://input'));


$table = $fields[$data->field];
$name = $data->name;

//$table = "coctails";
//$name = "Мохито";

$qwe = new SQLModelClass();
$qwe -> table($table);
$qwe -> select('*');
$qwe -> where("name='".$name."'");
$res = $qwe -> all();


//deb($res);

echo json_encode(['data' => $data, 'table' => $table, 'res' => $res]);