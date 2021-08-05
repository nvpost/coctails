<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 05.08.2021
 * Time: 17:10
 */

class ToolsClass
{
    public $coctail_id;
    public $table;
    public $fields;
    public $order;
    public $tags; //array
    public $tools; //array

    public function __construct($table, $fields, $coctail_id=false)
    {
        $this->table = $table;
        $this->fields = $fields;
        $this->tools = $this->getTags($coctail_id);
    }

    private function getTags($coctail_id){

        $where = ($coctail_id)?" coctail_id IN(".$coctail_id.")" : 1;
        $sql = "SELECT {$this->fields} FROM {$this->table} WHERE ".$where;
        $ingredients = pdSql($sql);
        return $ingredients;
    }
}