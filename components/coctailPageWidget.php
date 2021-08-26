<?php
$src = array_pop(explode('/', $coctail['src']));

function doLink($what, $l){
    global $home_url;
    $href = $home_url.$what.'='.$l;
    return "<a href='$href'>".$l."</a>";
}



require 'components/more_block/moreCoctails.php';
?>

<div class="coctail_page_container ">
    <div class="coctail_page coctail_item container">
        <div class="coctail_page_header ">
            <h1>
                <?=$coctail['name']?>
            </h1>
            <?php
                require_once "page_parts/raing_view.php";
            ?>

            <p>
                <?=$coctail['en_name']?>
            </p>
        </div>
        <div class="coctail_page_content">
            <div class="coctail_text_info">
                <p>
                    <?=$coctail['text_info']?>
                </p>
            </div>

            <div class="coctail_start_content">
                <div class="coctail_page_img">
                    <img src="<?=$home_url?>imgs/<?=$src?>" alt="">
                </div>
                <div class="coctail_page_info">
                    <?php
                        $table_name = "Ингредиенты";
                        $label = "ingredient";
                        $what = "ingredient";
                        $tools_arr = $coctail_ingredients;
                        require 'page_parts/tools_table.php'
                    ?>
                    <?php
                        $table_name = "Посуда и приборы";
                        $label = "name";
                        $what = "tool";
                        $tools_arr = $coctail_tools;
                        require 'page_parts/tools_table.php'
                    ?>
                </div>
            </div>
            <div class="coctail_middle_content">
                <?php
                    require_once 'page_parts/process.php';
                ?>
                <div class="coctail_tags">
                    <h4>Категории</h4>
                    <?php
                    $coctail_id = $coctail['coctail_id'];
                    foreach ($coctail_tags as $k =>$tag){
                        $href = $home_url.'tag='.$tag['tag'];
                        $class ='tags';
                        echo "<a class='{$class}' href='{$href}'>".str_replace(" ", "&nbsp;", $tag['tag'])."</a> ";
                    }


                    //require_once 'components/tags.php';
                    ?>
                </div>
            </div>

        </div>
    </div>
    <div class="coctail_bottom_content">
            <div class="more_from more_from_tag">
                <h3>Похожие коктейли</h3>
                <?php
                moreCoctailsFoo($coctail_tags, 'tags', 'tag');
                ?>
            </div>

            <div class="more_from more_from_ing">
                <h3>Коктейли из тех же ингредиентов</h3>
                <?php
                moreCoctailsFoo($coctail_ingredients, 'ingredients', 'ingredient');
                ?>
            </div>

            <div class="more_from more_from_tool">
                <h3>Коктейли с такими же аксессуарами</h3>
                <?php
                moreCoctailsFoo($coctail_tools, 'tools', 'name');
                ?>
            </div>
        </div>
    <div class="coctail_copyright">
        <a href="https://ru.inshaker.com<?=$coctail['origin_url']?>" target="_blank">Источник ru.inshaker.com </a>
    </div>
</div>

<script src="<?=$home_url?>assets/cart_item_scripts.js"></script>
