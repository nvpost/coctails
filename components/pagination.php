<?php
function drowPagination($c){
    global $page;
    global $limit;
    global $pagintation_step;

    $pages = ceil($c/$limit);
    $start_point = ($page-$pagintation_step>0)?$page-$pagintation_step:0;
    $fin_point = ($page+$pagintation_step<$pages)?$page+$pagintation_step:$pages;

    if($page>$pagintation_step){
        $prev_page = $start_point;
        echo "<a class='page' href='page={$prev_page}'>&lsaquo;</a>";
    }


    for ($i=$start_point; $i<$fin_point; $i++){
        $p = $i+1;
        $active = ($page==$i)?'active_page':'';
        echo "<a class='page {$active}' href='page={$p}'>{$p}</a>";
    }
    if($fin_point<$pages){
        $next_page = $fin_point+1;
        echo "<a class='page' href='page={$next_page}'>&rsaquo;</a>";
    }
}