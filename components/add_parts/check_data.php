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

//$qwe = new SQLModelClass();
//$qwe -> table($table);
//$qwe -> select('*');
//$qwe -> where("name='".$name."'");
//$res = $qwe -> all();

global $db;

$sql = "SELECT * FROM $table WHERE name='".$name."'";
$res = $db->prepare($sql);
$res->execute();
$data_res = $res->fetchAll(PDO::FETCH_ASSOC);



//deb($res);

echo json_encode(['data' => $data, 'table' => $table, 'res' => $data_res ]);