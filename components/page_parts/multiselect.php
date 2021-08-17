<?php
$keys = array_keys($arr);


$fixed_keys = array_map('fixKeys', $keys);

$inline_keys = "'" . implode("', '", $fixed_keys) . "'";

//Убрать trim для поиска
//Убрать замену ковычек


echo "<script>
        let arr_".$field."=[$inline_keys]
        </script>";


if(isset($filters[$field])){
    $values = "'".str_replace(';', "', '", $filters[$field])."'";


    echo "<script>
        value_".$field."=[$values]
        </script>";
}

?>




<div>
    <label class="typo__label">Поиск по <?=$label;?></label>
    <multiselect v-model="value_<?=$field?>"
                 :options="options_<?=$field?>"
                 :multiple="true"
                 @select="goToTag('<?=$field?>',$event)"
                 @remove="removeTag('<?=$field?>',$event)"
                 :searchable="true"
                 :close-on-select="true"
                 :show-labels="false"
                 placeholder="Выбрать"></multiselect>
    <pre class="language-json"><code>{{ value_<?=$field?>  }}</code></pre>
</div>
