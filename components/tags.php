<?php
$tags = new TagClass();

echo "<div class='tag_container container'>";
foreach ($tags->tags as $k =>$tag){
    $t = $tag['tag'];
    $href = $home_url.'tag='.$t;
    $class = ($t == $active_tag) ? 'tags tags_active' : 'tags';
    echo "<a class='{$class}' href='{$href}'>{$t}</a>";
}
echo "</div>";