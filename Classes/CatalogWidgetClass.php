<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 04.06.2021
 * Time: 16:34
 */

class CatalogWidgetClass
{
    public $coctails;

    public function __construct($coctails)
    {
        $this->coctails = $coctails;
    }

    public function getCatalogItem(){
        $catalogHtml="";
        foreach($this->coctails as $k=>$item){
            $catalogHtml .= $this->drow_catalog_item($item);
        }
        return $catalogHtml;
    }

    public function drow_catalog_item($item){
    $src = array_pop(explode('/',$item['src']));

    $catalog_item_html = "<div class='catalog_item'>";
    $catalog_item_html .= "<div class='catalog_item_img'>";
    $catalog_item_html .="<img src='imgs/{$src}'>";
    $catalog_item_html .= "</div>";

    $catalog_item_html .= "<div class='catalog_item_label'>";
    $catalog_item_html .="<h2>{$item['name']}</h2>";
    $catalog_item_html .= "</div>";

    $catalog_item_html .= "</div>";

    return $catalog_item_html;
    }
}