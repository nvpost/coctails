<?php
$filters = prepareUrl();

$tags = new ToolsClass('tags', 'tag'); //false, filters

$tags->getFilteredTags($filters);

//deb(count($tags->tools));
$tags = $tags->tools;




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