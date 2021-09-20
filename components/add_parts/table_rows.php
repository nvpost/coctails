<?php


?>

<div class="table_data_row" v-for="(row, row_index) in <?=$model?>">
    <span>{{row_index+1}}. </span>
    <?php if(isset($model_tails[0])){ ?>
        <input type="text"
               class="input_name"
               placeholder="<?=$placeholders[0]?>"
               v-model="<?=$model?>[row_index].<?=$model_tails[0]?>"
               @blur="checkForAddRow('<?=$model?>', row_index)"
               :key="row_index+'_<?=$model_tails[0]?>'"
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