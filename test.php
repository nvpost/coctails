<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

require_once 'func.php';

$sqlClass = new SQLModelClass();

$sqlClass->table('coctails')
    ->select('*')
    ->limit(5)
    ->where(1)
    ->all();



deb($sqlClass->sqlArray);