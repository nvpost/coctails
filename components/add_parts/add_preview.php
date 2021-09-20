<?php
?>

<h3>Превью</h3>
<div class="coctail_page coctail_item container">
    <div class="coctail_page_header ">
        <h2>
            {{coctail_label}}
        </h2>

        <h3>
            {{coctail_label_en}}
        </h3>

    </div>
    <div class="coctail_page_content">
        <div class="coctail_text_info">
            <p>
                {{coctail_descr}}
            </p>
        </div>

        <div class="coctail_start_content">
            <div class="coctail_page_img">
                <img src="" alt="" id ="preview_img">
            </div>
            <div class="coctail_page_info">
                <div class="tools_field">
                    <div class="tools_table" v-if="ing_rows[0].ingredient">
                        <h4>Ингредиенты</h4>
                        <table>
                                <tr v-for="(row, index) in ing_rows">
                                    <td class="tool_name">{{row.ingredient}}</td>
                                    <td class="tool_amount">{{row.amount}}</td>
                                    <td>{{row.unit}}</td>
                                </tr>
                        </table>
                    </div>

                    <div class="tools_table" v-if="tools_rows[0].name">
                        <h4>Штуки</h4>
                        <table>
                            <tr v-for="(row, index) in tools_rows">
                                <td class="tool_name">{{row.name}}</td>
                                <td class="tool_amount">{{row.amount}}</td>
                                <td>{{row.unit}}</td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <div class="coctail_middle_content">

            <div class="coctail_tags">
                <h4>Категории</h4>
                <?php

                //require_once 'components/tags.php';
                ?>
            </div>
        </div>

    </div>
</div>
