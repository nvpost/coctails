<?php
$ingredients = new IngredientsClass();
$ingredients = $ingredients->ingredients;

echo "<div class='ingredients_container container'>";
foreach ($ingredients as $k =>$ingredient){
    $t = $ingredient['ingredient'];

    $href = $home_url.'ingredient='.$t;
    echo "<a class='tags ingredient' href='{$href}'>{$t}</a>";
}
echo "</div>";