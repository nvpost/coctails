<?php

$frontStart = $page*$limit+1;
$frontFin = ($page+1)*$limit;

$set_limit = $page*$limit.", ".$limit;

function drowPagination($c){
    global $page;
    global $page_tags;
    global $limit;
    global $pagintation_step;

    $pages = ceil($c/$limit);
    $start_point = ($page-$pagintation_step>0)?$page-$pagintation_step:0;
    $fin_point = ($page+$pagintation_step<$pages)?$page+$pagintation_step:$pages;

    $part_link=doRoute();
    deb($part_link);
    if($page_tags){
        $tag = $page_tags[0];
        $part_link = "tag={$tag}";
    }

    if($page>$pagintation_step){
        $prev_page = $start_point;
        $href = $part_link . $prev_page;
        echo "<a class='page' href={$href}>&lsaquo;</a>";
    }



    for ($i=$start_point; $i<$fin_point; $i++){
        $p = $i+1;
        $href = ($part_link)?"'".$part_link . "&page={$p}'":"page={$p}";
        $active = ($page==$i)?'active_page':'';
        echo "<a class='page {$active}' href={$href}>{$p}</a>";
    }
    if($fin_point<$pages){
        $next_page = $fin_point+1;
        $href = $part_link . $next_page;
        echo "<a class='page' href={$href}>&rsaquo;</a>";
    }

    echo " <span class='count_pages_and_items'>(".$c." / ".$pages.")</span>";
}