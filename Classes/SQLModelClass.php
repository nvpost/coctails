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
        $this->sqlArray['table'] = $table_str;
        return $this;
    }

    public function select($select_str){
        $this->sqlArray['select'] = $select_str;
        return $this;
    }

    public function where($where_str){
        $this->sqlArray['where'] = $where_str;
        return $this;
    }
    public function limit($l){
        $this->sqlArray['limit'] = $l;
        return $this;
    }


    //Сделать запрос
    public function all(){
        $sql = $this->sqlArray;
        $qwe = "";
        if(isset($this->sqlArray['select'])){
            $qwe .= "SELECT {$this->sqlArray['select']} ";
        }
        if(isset($this->sqlArray['table'])){
            $qwe .= "FROM {$this->sqlArray['table']} ";
        }
        if(isset($this->sqlArray['where'])){
            $qwe .= "WHERE {$this->sqlArray['where']} ";
        }
        if(isset($this->sqlArray['limit'])){
            $qwe .= "LIMIT {$this->sqlArray['limit']} ";
        }else{
            deb('ff');
        }
        deb($qwe);
//        deb($this->sqlArray);
        return $this;
    }
}