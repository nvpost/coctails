<?php

$ingredients = new ToolsClass('ingredients', 'ingredient');

$ingredients->getFilteredTags($filters);

$ingredients = $ingredients->tools;


echo "<div class='ingredients_container container tag_container'>";
echo "<h4>Ингредиенты</h4>";


$arr = flatAndCount($ingredients, 'ingredient');

dooToolsContent($arr, 'ingredient', $filters);


echo "</div>";
