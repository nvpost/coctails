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


    public function getCatalogItem($slider=false){
        $catalogHtml="";
        foreach($this->coctails as $k=>$item){
            $catalogHtml .= $this->drow_catalog_item($item, $slider);
        }
        return $catalogHtml;
    }

    public function getSliderCatalogItem(){
        $catalogHtml="";
        foreach($this->coctails as $k=>$item){
            $catalogHtml .= $this->drow_sloder_catalog_item($item);
        }
        return $catalogHtml;
    }


    public function drow_catalog_item($item, $slider){
        global $home_url;
        $src = array_pop(explode('/',$item['src']));
        $catalog_item_html = "<a class='catalog_item' href='{$home_url}coctail/{$item['en_name']}'>";
        $catalog_item_html .= "<div class='catalog_item_img'>";
        $catalog_item_html .="<img src='{$home_url}imgs/{$src}'>";
        $catalog_item_html .= "</div>";

        $catalog_item_html .= "<div class='catalog_item_label'>";
        $catalog_item_html .= "<div class='catalog_item_label_inner'>";
        $catalog_item_html .="<h3>{$item['name']}</h3>";
        $catalog_item_html .="<p>{$item['en_name']}</p>";
        $catalog_item_html .= "</div>";
        $catalog_item_html .= "</div>";

        $catalog_item_html .= "</a>";

        $catalog_item_html = ($slider)?"<li class='splide__slide'>".$catalog_item_html."</li>":$catalog_item_html;

        return $catalog_item_html;
    }


//    public function drow_sloder_catalog_item($item){
//        $src = array_pop(explode('/',$item['src']));
//        <li class="splide__slide">
//        $catalog_item_html = "<a class='catalog_item' href='{$home_url}coctail/{$item['en_name']}'>";
//        $catalog_item_html .= "<div class='catalog_item_img'>";
//        $catalog_item_html .="<img src='{$home_url}imgs/{$src}'>";
//        $catalog_item_html .= "</div>";
//
//        $catalog_item_html .= "<div class='catalog_item_label'>";
//        $catalog_item_html .= "<div class='catalog_item_label_inner'>";
//        $catalog_item_html .="<h3>{$item['name']}</h3>";
//        $catalog_item_html .="<p>{$item['en_name']}</p>";
//        $catalog_item_html .= "</div>";
//        $catalog_item_html .= "</div>";
//
//        $catalog_item_html .= "</a>";
//
//        return $catalog_item_html;
//    }
}