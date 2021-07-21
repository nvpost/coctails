<?php

echo "<div class='header_container container'>";
echo "<div class='page_header_title'>";
echo "<h2>Коктейли <span class='page_tag_item'>{$active_tag}</span></h2> ";
echo " <a href='{$home_url}'>&#10006;</a>";
echo "</div>";

$fin_digit = ($frontFin<$countCoctails) ? $frontFin : $countCoctails;

echo "<p>Показано {$frontStart} - {$fin_digit} (из {$countCoctails})</p>";

echo "</div>";


//echo "<div class='page_header'>";
//
//
//echo "</div>";