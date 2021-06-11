<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 02.06.2021
 * Time: 16:27
 */

class getCoctailsClass
{
    protected $limit;
    protected $page_offset;
    public $pages;


    public function __construct()
    {
        $this->limit = 20;
    }

    public function getAll(){
        $sql = "SELECT * FROM coctails WHERE 1 LIMIT ".$this->limit;
        $coctails = pdSql($sql);
        $this->pagination();
        return $coctails;
    }

    public function getFromTags(){

    }

    public function getFromIngredients(){

    }

    public function getFromTagsAndIngredients(){

    }

    public function pagination($all=true){
        if($all){
            $sql = "SELECT * FROM coctails WHERE 1 ".$this->limit;
            $res = pdSql($sql);
            $pages = count($res);
            $this->pages = $pages;
            return $pages;
        }

    }
}