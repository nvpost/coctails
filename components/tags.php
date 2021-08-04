<?php

$tags = new TagClass($coctail_id);

//$tags ->getTagCoctailCount();


$part_link = "";
$part_link = ($page)? $home_url."page={$page}":$home_url;

echo "<div class='tag_container'>";
echo "<h4>Категории</h4>";

$flat_tags = array_column($tags->tags, 'tag');
$flat_tags_with_count = array_count_values($flat_tags);
foreach ($flat_tags_with_count as $k =>$count){
    $t = $k;

    $href = $home_url.'tag='.$t;
    $commonUrl = dooUrl('tag');

//    $href = ($commonUrl) ? $home_url.'tag='.$t.$commonUrl : $home_url.'tag='.$t;


    $class = ($t == $active_tag) ? 'tags tags_active' : 'tags';
    echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $t)."&nbsp;(".$count.")</a> ";
}
echo "</div>";