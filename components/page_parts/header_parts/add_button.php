<?php

function addBotton(){
    global $home_url;
    $html = "<div class='add_buttom_bar'>";
    $html .="<a href='{$home_url}add_coctail'>Добавить свой коктейль</a>";

    $html .="</div>";

    return $html;
}