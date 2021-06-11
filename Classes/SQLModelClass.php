<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 10.06.2021
 * Time: 15:31
 */

class SQLModelClass
{
    public $sqlArray;

    public function __construct()
    {
        $this->sqlArray = [];
    }

    public function table($table_str){
        $row = ['table'=>$table_str];
        array_push($this->sqlArray, $row);
    }

    public function where($where_str){
        $row = ['WHERE'=>$where_str];
        array_push($this->sqlArray, $row);
    }
    public function limit($l){
        $row = ['LIMIT'=>'LIMIT '.$l];
        array_push($this->sqlArray, $row);
    }
}