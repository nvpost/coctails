<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

require_once 'func.php';

$sqlClass = new SQLModelClass();

$sqlClass->table('board')
    ->select('*')
    ->limit(5)
    ->where('con = true')
    ->all();



deb($sqlClass->sqlArray);