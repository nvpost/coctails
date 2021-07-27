<?php
$tags = new TagClass($coctail_id );

$part_link = "";
$part_link = ($page)? $home_url."page={$page}":$home_url;

echo "<div class='tag_container'>";
foreach ($tags->tags as $k =>$tag){
    $t = $tag['tag'];

    $href = $home_url.'tag='.$t;

    $class = ($t == $active_tag) ? 'tags tags_active' : 'tags';
    echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $t)."</a> ";
}
echo "</div>";