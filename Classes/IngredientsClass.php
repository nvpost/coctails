<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 01.06.2021
 * Time: 14:55
 */

class IngredientsClass
{
    public $coctail_id;
    public $tags; //array
    public $ingredients; //array

    public function __construct($coctail_id=false)
    {
        $this->ingredients = $this->getTags($coctail_id);
    }

    private function getTags($coctail_id){
        $sql = "SELECT DISTINCT ingredient FROM ingredients WHERE 1";
        $ingredients = pdSql($sql);
        return $ingredients;
    }


}