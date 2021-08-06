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
    public $filters;

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

    public function getFilteredTags($filters){

        $tablesArr = [];
        $valArr=[];
        foreach ($filters as $table => $val){
            $table = ($table == 'tag')?'tags.*':$table."*";
            array_push($tablesArr, $table);
            $val = explode(';', $val);
            array_push($valArr, $val);
        }
        $tables = implode(',', $tablesArr);
        $vals = "'" .implode("', '", $valArr[0]) ."'";
        deb($vals);
        $sql = "SELECT DISTINCT coctails.coctail_id  FROM coctails, tags, ingredients 
          WHERE 
          tags.tag IN(".$vals.")
          AND coctails.coctail_id = tags.coctail_id";
        deb($sql);
        $cictails_id_arr = pdSql($sql);
        $coctail_id = array_column($cictails_id_arr, 'coctail_id');
        $coctail_id = "'" .implode("', '", $coctail_id) ."'";

//        deb($coctail_id);
//        $relativeTags = $this->getTags($coctail_id);
//        deb($relativeTags)
        $this->tools =  $this->getTags($coctail_id);



    }
}