<?php
//$ingredients = new IngredientsClass();
//$ingredients = $ingredients->ingredients;
$ingredients = new ToolsClass('ingredients', 'ingredient');
$ingredients = $ingredients->tools;

echo "<div class='ingredients_container container tag_container'>";
echo "<h4>Ингредиенты</h4>";


$arr = flatAndCount($ingredients, 'ingredient');

dooToolsContent($arr, 'ingredient', $active_ingredient);
//foreach ($arr as $k =>$count){
//    $t = $k;
//    $href = $home_url.'ingredient='.$t;
//    $href=(doRoute()) ? $home_url.doRoute().'&ingredient='.$t:$home_url.'ingredient='.$t;
//
//    $class = ($t == $active_ingredient) ? 'tags tags_active' : 'tags';
//    echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $t)."&nbsp;(".$count.")</a> ";
//}

echo "</div>";