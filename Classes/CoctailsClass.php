<?php
/**
 * Created by PhpStorm.
 * User: n.balashov
 * Date: 24.05.2021
 * Time: 17:18
 */
// SELECT coctails.*, tags.* FROM coctails, tags WHERE tags.tag='мятные' AND tags.coctail_id = coctails.coctail_id
class CoctailsClass
{
    public $tag_id;
    public $ingredient_id;
    public $tool_id;
    public $coctails_isd;

    public function __construct($coctail_data=array())
    {
        if(isset($coctail_data['tag'])){
            $this->coctails_isd = getIdsFormTag($coctail_data['tag']);
        }
        $this->tag_id = isset($coctail_data['tag_id'])?$coctail_data['tag_id']:false;
        $this->ingredient_id = isset($coctail_data['ingredient_id'])?$coctail_data['ingredient_id']:false;
        $this->tool_id = isset($coctail_data['tool_id'])?$coctail_data['tool_id']:false;
    }


    public function getCoctailsFormTag($tag){
        deb($tag);
        $sql = "SELECT DISTINCT coctail_id FROM tags WHERE tag='{$tag}'";
        $coctails_isd = pdSql($sql);
        $ids = array();
        deb($sql);
        $idsSet = "";
        foreach ($coctails_isd as $k => $c){
            $sep = ($k==count($coctails_isd)-1)?"":", ";
            $idsSet.=$c['coctail_id'].$sep;
        }
        $coctails = $this->getCoctails($idsSet);


        return $coctails;
    }

    public function getCoctails($ids=false){
        if($ids){
            $sql = "SELECT * FROM coctails WHERE coctail_id IN({$ids})";
        }else{
            $sql = "SELECT * FROM coctails WHERE 1";
        }

        $coctails = pdSql($sql);

        return $coctails;
    }
}