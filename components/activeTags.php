<?php
//deb($filters);
echo "<div class='active_tags'>";
foreach ($filters as $key => $f){
    $f = explode(';', $f);
    $ru_key="";
    if($key=="tag"){
        $ru_key = 'Категории';
    }
    if($key=="ingredient"){
        $ru_key = 'Ингредиенты';
    }
    if($key=="tool"){
        $ru_key = 'Штуки';
    }
    echo "<div class='active_tags_line'>";
    echo "<div class='line_tag_header'>$ru_key: </div>";
    foreach ($f as $i => $tag){
        echo drowTags($key, $tag);
    }
    echo "</div>";
}
echo "</div>";

function drowTags($key, $tag){
    $val = str_replace(' ', '_', $tag);
    return "<div class='active_tags_item' data-key='{$key}', data-val='{$tag}' onclick=removeTag('{$key}','{$val}')><span>$tag</span><i class='fa fa-times' aria-hidden='true'></i></div>";
}