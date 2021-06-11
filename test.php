<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/'.$class_name . '.php';
});

require_once 'func.php';

$sqlClass = new SQLModelClass();

$sqlClass->limit(5);
$sqlClass->where('con = true');


deb($sqlClass->sqlArray);