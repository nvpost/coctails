<?php
deb($filters);
foreach ($filters as $key => $f){
    $f = explode(';', $f);
    foreach ($f as $i => $tag){
        deb($tag);
    }
}