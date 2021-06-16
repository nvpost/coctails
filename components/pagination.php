<?php
function drowPagination($c){
    global $page;
    deb($page);
    global $limit;
    $pages = ceil($c/$limit);
//    deb($pages);
    for ($i=0; $i<$pages; $i++){
        $p = $i+1;
        $active = ($page==$i)?'active_page':'';
        echo "<a class='page {$active}' href='page={$p}'>{$p}</a>";
    }
}