<?php

$coctails = new oldCoctailsClass();
$tag = $_GET['tag'];
$coctailsFromTag = $coctails->getCoctailsFormTag($tag);

deb(count($coctailsFromTag));

deb($coctailsFromTag);

