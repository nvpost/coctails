<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 24.05.2021
 * Time: 16:23
 */

class TagClass
{
    public $coctail_id;
    public $tags; //array

    public function __construct($coctail_id=false)
    {
        $this->tags = $this->getTags($coctail_id);
    }

    private function getTags($coctail_id){
        $where = ($coctail_id)?" coctail_id=".$coctail_id : 1;
        $sql = "SELECT DISTINCT tag FROM tags WHERE ".$where;
        $tags = pdSql($sql);
        return $tags;
    }
}