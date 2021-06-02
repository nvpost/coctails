<?php
$ingredients = new IngredientsClass();
$ingredients = $ingredients->ingredients;

foreach ($ingredients as $k =>$ingredient){
    $t = $ingredient['ingredient'];
    $href = $home_url.'ingredient/'.$t;
    echo "<a class='tags ingredient' href='{$href}'>{$t}</a>";
}