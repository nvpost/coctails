<?php

$sql = "select * from users where uid='{$uid}' and method='{$log_method}'";
$user = pdSql($sql)[0];