<?php


?>

<template v-for="(row, row_index) in <?=$model?>">
    <div class="table_data_row">
    <?php if(isset($model_tails[0])){ ?>

        <input type="text"
               class="input_name"
               placeholder="<?=$placeholders[0]?>"
               v-model="<?=$model?>[row_index].<?=$model_tails[0]?>"
               @blur="checkForAddRow('<?=$model?>', row_index)"
               :key="row_index+'_<?=$model_tails[0]?>'"
               @keyUp="ShowHint($event, '<?=$model_tails[0];?>')"
        >
    <?php }?>
    <?php if(isset($model_tails[1])){ ?>
        <input type="text"
               class="input_kolvo"
               placeholder="<?=$placeholders[1]?>"
               v-model="<?=$model?>[row_index].<?=$model_tails[1]?>"
               @blur="checkForAddRow('<?=$model?>', row_index)"
               :key="row_index+'_<?=$model_tails[1]?>'"
        >
    <?php }?>
    <?php if(isset($model_tails[2])){ ?>
        <select name="unit"
                v-model="<?=$model?>[row_index].<?=$model_tails[2]?>"
                @blur="checkForAddRow('<?=$model?>', row_index)"
                :key="row_index+'_<?=$model_tails[2]?>'"
        >
            <option v-for="(unit, index) in ing_units" :value="unit" >{{unit}}</option>
        </select>
    <?php }?>
    <i class="fas fa-trash"
       v-if="validateRow('<?=$model?>', row_index)"
       @click="deleteRow('<?=$model?>', row_index)"
    ></i>

    </div>

    <?php if($model_tails[0]!='process_row'):?>
        <div class="tools_hint" v-if="<?=$model_tails[0]?>_hints.length>0 && row_index==(<?=$model?>.length-1)">

            <div class="tools_hint_btn"
                 v-for="(tool, index) in ingredient_hints.slice(0, 5)"
                 :data-row="row_index"
                 @click="setModelFromTag($event,tool)"
            >
                {{tool}}
            </div>
        </div>
    <?php endif;?>


</template>


