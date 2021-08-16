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
    public $unionIds;

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
        if(!$filters){
            return false;
        }

        $this->unionIds = [];

        $c_ids_arr = [];
        foreach ($filters as $table => $val){
            $val = explode(';', $val);
            foreach ($val as $v){
                if($table == 'tag'){
                    $where = "tags.tag = '".$v."'";
                }
                if($table == 'ingredient'){
                    $where = "ingredients.ingredient = '".$v."'";
                }
                if($table == 'tool'){
                    $where = "tools.name = '".$v."'";
                }

                $sql = "SELECT DISTINCT coctails.coctail_id  FROM coctails, {$table}s
                      WHERE {$where}
                      AND coctails.coctail_id = {$table}s.coctail_id";
//                deb($sql);
                $flat_c_ids = pdSql($sql);

                $flat_c_ids = array_column($flat_c_ids, 'coctail_id');
                $this->unionIds = (count($this->unionIds)==0) ? $flat_c_ids : array_intersect($this->unionIds, $flat_c_ids);
                $c_ids_arr[] = $flat_c_ids;

            }
        }



        $coctail_id = "'" .implode("', '", $this->unionIds) ."'";


        $relativeTags = $this->getTags($coctail_id);
        $this->tools = $relativeTags;
    }
}