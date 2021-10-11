<?php
require_once '../config.php';

?>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://unpkg.com/vue-multiselect@2.1.0" type="application/javascript"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="<?=$home_url?>assets/css.css"></link>
    <link rel="stylesheet" href="<?=$home_url?>assets/add_coctail.css"></link>
</head>
<body>
<div class="add_app container" id="add_app">
    <div class="add_form">
        <form action="">
            <div class="add_form_main_info">
                <div class="main_info_label">
                    <input type="text" name="coctail_label"
                           class="coctail_label"
                           placeholder="Название*"
                           v-model="coctail_label"
                           @blur="checkItem('coctail_label')"
                    >
                    <input type="text" name="coctail_label_en"
                           class="coctail_label_en"
                           placeholder="Название (eng)"
                           v-model="coctail_label_en"
                    >

                </div>
                <div class="existing_coctail" v-if="existing_coctail.name">
                    <p>Такой уже есть
                        <a href="/coctail/{{existing_coctail.en_name}"
                           target="_blank"
                        >
                            {{existing_coctail.name}} ({{existing_coctail.en_name}})
                        </a></p>
                </div>
                <textarea name="coctail_descr"
                          placeholder="Описание"
                          v-model="coctail_descr"
                ></textarea><br>
                Картинка:
                <input
                    type="file"
                    v-model="img_src"
                    @change = "add_preview"
                    id="img_upload"
                >
            </div>
            <div class="coctail_tags">
                <h3>Категории (выбрать одну или несколько)</h3>
                <div class="tag_list" v-if="tag_list.length>0">
                    <div
                            class="tag_item"
                            v-for="tag in tag_list"
                            @click="addTag($event)"
                            :class="selected_tags.indexOf(tag)>-1?'selected_tag':''"
                    >{{tag}}</div>
                </div>
                <div class="loading" v-else>
                    <img src="assets/icons/Rhombus.gif" alt="">
                </div>
            </div>
            <div class="table_data">
                <div class="ing_rows add_table_rows">
                    <h3>Ингредиенты</h3>
                    <?php
                        $model = "ing_rows";
                        $placeholders = ["Ингредиент*", "Сколько*"];
                        $model_tails = ["ingredient", "amount", "unit"];
                        require "../components/add_parts/table_rows.php";
                    ?>

                </div>
                <div class="tools_rows add_table_rows">
                    <h3>Штуки</h3>
                    <?php
                    $model = "tools_rows";
                    $placeholders = ["Штука (лед, трубочка, бокал...)*", "Сколько*"];
                    $model_tails = ["name", "amount", "unit"];
                    require "../components/add_parts/table_rows.php";
                    ?>
                </div>

                <div class="process_rows add_table_rows">
                    <h3>Как делать</h3>
                    <?php
                    $model = "process_rows";
                    $placeholders = ["налить это вот туда*"];
                    $model_tails = ["process_row"];
                    require "../components/add_parts/table_rows.php";
                    ?>
                </div>


            </div>
        </form>

        <button @click="saveData()" :disabled="checkFormData()">Сохранить</button>

        <?php
            require_once '../components/add_parts/add_preview.php';
        ?>
    </div>
</div>


</body>

<script src="<?=$home_url?>assets/add_front.js"></script>
<script>
    addApp.setTemplate()
</script>

