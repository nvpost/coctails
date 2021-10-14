<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 27.08.2021
 * Time: 12:41
 */

class metaClass
{

    public $title;
    public $description;

    public function __construct(){

    }

    public function title($title){
        $this->title = "<title>{$title}</title>";
        return $this->title;
    }

    public function description($descr){
        $this->description = "<meta name='description' content='{$descr}'>";
        return $this->description;
    }
}