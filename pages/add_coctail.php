<?php
require_once '../config.php';

?>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://unpkg.com/vue-multiselect@2.1.0" type="application/javascript"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="<?=$home_url?>assets/add_coctail.css"></link>
</head>

<div class="add_app" id="add_app">
    <div class="add_form">
        <form action="">
            <div class="add_form_main_info">
                <input type="text" placeholder="Название">*<br>
                <input type="text" placeholder="Название (eng)"><br>
                <textarea placeholder="Описание"></textarea><br>
                Картинка: <input type="file">
            </div>
            <div class="add_form_ingredients">
                <div class="ingredient_row" v-for="(ing_row, ing_row_index) in ing_rows">
                    {{ing_row_index+1}} )
                    {{ing_rows}}
                    {{ing_rows_template}}
                    <input type="text"
                           placeholder="Ингредиент"
                           v-model="ing_rows[ing_row_index].ingredient"
                           @blur="checkForAddRow('ing_rows', ing_row_index)"
                    >*<br>
                    <input type="text"
                           placeholder="Сколько"
                           v-model="ing_rows[ing_row_index].amount"
                           @blur="checkForAddRow('ing_rows', ing_row_index)"
                    >*<br>
                    <select name="unit"
                            v-model="ing_rows[ing_row_index].unit"
                            @blur="checkForAddRow('ing_rows', ing_row_index)"
                    >
                        <option v-for="(unit, index) in ing_units" :value="unit" >{{unit}}</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?=$home_url?>assets/add_front.js"></script>
