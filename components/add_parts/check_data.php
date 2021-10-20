<?php




include "../../Classes/SQLModelClass.php";
require "../../func.php";

//TODO Нужна проверка на статус
$fields=[
    'coctail_label' => 'coctails',
    'coctail_label_en' => 'coctails'
];

$data = json_decode(file_get_contents('php://input'));


$table = $fields[$data->field];
$name = $data->name;

//$table = "coctails";
//$name = "Мохито";


global $db;

if($data->field=='coctail_label'){
    $sql = "SELECT * FROM $table WHERE name='".$name."'";
}
else{
    $sql = "SELECT * FROM $table WHERE en_name='".$name."'";
}



$res = $db->prepare($sql);
$res->execute();
$data_res = $res->fetchAll(PDO::FETCH_ASSOC);



//deb($res);

echo json_encode(['data' => $data, 'table' => $table, 'res' => $data_res]);