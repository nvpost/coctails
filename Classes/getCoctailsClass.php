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


    public function __construct()
    {
        $this->limit = 20;
    }

    public function getAll(){
        $sql = "SELECT * FROM coctails WHERE 1 LIMIT ".$this->limit;
        $coctails = pdSql($sql);
        return $coctails;
    }

    public function getFromTags(){

    }

    public function getFromIngredients(){

    }

    public function getFromTagsAndIngredients(){

    }
}