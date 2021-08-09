<?php


$tags = new ToolsClass('tags', 'tag'); //false, filters

$tags->getFilteredTags($filters);

$tags = $tags->tools;




echo "<div class='tag_container'>";
echo "<h4>Категории</h4>";


$arr = flatAndCount($tags, 'tag');

dooToolsContent($arr, 'tag', $filters);

echo "</div>";