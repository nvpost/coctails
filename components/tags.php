<?php
$tags = new TagClass();

foreach ($tags->tags as $k =>$tag){
    $t = $tag['tag'];
    $href = $home_url.'tag/'.$t;
    echo "<a class='tags' href='{$href}'>{$t}</a>";
}