<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 27.08.2021
 * Time: 12:41
 */

class metaClass
{

    public function title($title){
        $title = "<title>{$title}</title>";
        return $title;
    }
}