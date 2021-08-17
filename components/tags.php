<?php
$tags_block=array(
    [
        'table'=>'tags',
        'field'=>'tag',
        'label'=>'Категории'
    ],
    [
        'table'=>'ingredients',
        'field'=>'ingredient',
        'label'=>'Ингредиенты'
    ],
    [
        'table'=>'tools',
        'field'=>'name',
        'label'=>'Штуки'
    ]
);

function fixKeys($n){
    $str = trim($n);
    $str = str_replace("'", '', $str);
    return $str;
}
echo "<script>
let value_tag, value_name, value_ingredient=[]
</script>";


foreach ($tags_block as $block){
    drowTagsBlock($block['table'], $block['field'], $block['label']);
}

function drowTagsBlock($table, $field, $label){
    global $filters;

    $tags = new ToolsClass($table, $field); //false, filters

    $tags->getFilteredTags($filters);
    $tags = $tags->tools;
//    deb(count($tags));

    echo "<div class='tag_container index_tags block_".$field."'>";
    echo "<h4>{$label}</h4>";

        $arr = flatAndCount($tags, $field);



        require 'page_parts/multiselect.php';

        dooToolsContent($arr, $field, $filters);
        if(count($arr)>12){
            echo "<div class='tag_button' onclick=showTrigger('".$field."')>Показать еще {$label}</div>";
        }

    echo "</div>";
}


?>





