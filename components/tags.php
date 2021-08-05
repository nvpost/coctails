<?php

$tags = new ToolsClass('tags', 'tag');
$tags = $tags->tools;


//$tags ->getTagCoctailCount();


//$part_link = "";
//$part_link = ($page)? $home_url."page={$page}":$home_url;

echo "<div class='tag_container'>";
echo "<h4>Категории</h4>";


$arr = flatAndCount($tags, 'tag');

dooToolsContent($arr, 'tag', $active_tag);
//foreach ($arr as $k =>$count){
//    $t = $k;
//    $href = $home_url.'tag='.$t;
//    $class = ($t == $active_tag) ? 'tags tags_active' : 'tags';
//    echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $t)."&nbsp;(".$count.")</a> ";
//}
echo "</div>";