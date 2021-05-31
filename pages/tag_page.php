<?php

$coctails = new CoctailsClass();
$tag = $_GET['tag'];
$coctailsFromTag = $coctails->getCoctailsFormTag($tag);

deb($coctailsFromTag);

