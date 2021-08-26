<?php
session_start();
require_once '../config.php';
$return_url = ($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:$home_url;

session_destroy();

header("Location: {$return_url}");
