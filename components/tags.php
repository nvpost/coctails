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
foreach ($tags_block as $block){
    drowTagsBlock($block['table'], $block['field'], $block['label']);
}

function drowTagsBlock($table, $field, $label){
    global $filters;

    $tags = new ToolsClass($table, $field); //false, filters

    $tags->getFilteredTags($filters);
    $tags = $tags->tools;
//    deb(count($tags));
//    deb(count($tags));

    echo "<div class='tag_container index_tags block_".$field."'>";
    echo "<h4>{$label}</h4>";

        $arr = flatAndCount($tags, $field);
        dooToolsContent($arr, $field, $filters);
    echo "<div class='tag_button' onclick=showTrigger('".$field."')>Показать еще {$label}</div>";
    echo "</div>";
}





//$tags = new ToolsClass('ingredients', 'ingredient'); //false, filters
//
//$tags->getFilteredTags($filters);
//$tags = $tags->tools;
//
//echo "<div class='tag_container index_ingredients>";
//echo "<h4>Ингредиенты</h4>";
//
//    $arr = flatAndCount($tags, 'ingredient');
//    dooToolsContent($arr, 'ingredient', $filters);
//
//echo "</div>";
//
//$tags = new ToolsClass('tools', 'name'); //false, filters
//
//$tags->getFilteredTags($filters);
//$tags = $tags->tools;
//
//echo "<div class='tag_container index_tools'>";
//echo "<h4>Штуки</h4>";
//
//    $arr = flatAndCount($tags, 'name');
//    dooToolsContent($arr, 'name', $filters);
//
//echo "</div>";

