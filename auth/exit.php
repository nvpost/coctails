<?php
session_start();
$return_url = $_SERVER['HTTP_REFERER'];
session_destroy();

header("Location: {$return_url}");
