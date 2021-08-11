<?php
deb($filters);
echo "<div class='active_tags'>";
foreach ($filters as $key => $f){
    $f = explode(';', $f);
    echo "<div class='active_tags_line'>";
    echo "<div class='line_tag_header'>$key: </div>";
    foreach ($f as $i => $tag){
        echo drowTags($key, $tag);
    }
    echo "</div>";
}
echo "</div>";

function drowTags($key, $tag){
    return "<div class='active_tags_item'><span>$tag</span><i class='fa fa-times' aria-hidden='true'></i></div>";
}