<?php
function drowPagination($c){
    global $limit;
    $pages = ceil($c/$limit);
//    deb($pages);
    for ($i=0; $i<$pages; $i++){
        $p = $i+1;
        echo "<a class='page' href='{$p}'>{$p}</a>";
    }
}