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
                <input type="text" placeholder="Название*"><br>
                <input type="text" placeholder="Название (eng)"><br>
                <textarea placeholder="Описание"></textarea><br>
                Картинка:
                <input
                    type="file"
                    v-model="img_src"
                    @change = "add_prewiev"
                >
                <div class="preview_img">
                    <img src="" alt="" id ="preview_img" >
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
                    $placeholders = ["Штука*", "Сколько*"];
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
    </div>
</div>


</body>

<script src="<?=$home_url?>assets/add_front.js"></script>
<script>
    addApp.setTemplate()
</script>

