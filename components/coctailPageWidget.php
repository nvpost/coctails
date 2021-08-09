<?php
$src = array_pop(explode('/', $coctail['src']));

function doLink($what, $l){
    global $home_url;
    $href = $home_url.$what.'='.$l;
    return "<a href='$href'>".$l."</a>";
}

?>

<div class="coctail_page_container container">
    <div class="coctail_page_header">
        <h1>
            <?=$coctail['name']?>
        </h1>
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
                    $what = "tools";
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
                <?php
                $coctail_id = $coctail['coctail_id'];
                require_once 'components/tags.php';
                ?>
            </div>
        </div>
        <div class="coctail_bottom_content">
            <div class="more_from more_from_tag">
                <h3>Похожие коктейли</h3>
                <?php
                    require_once 'more_block/moreForTags.php';
                ?>
            </div>

            <div class="more_from more_from_ing">
                <h3>Коктейли из тех же ингредиентов</h3>
                <?php
                    require_once 'more_block/moreForIng.php';
                ?>
            </div>

            <div class="more_from more_from_ing">
                <h3>Коктейли с такими же аксессуарами</h3>
                    <?php
                        require_once 'more_block/moreForTools.php';
                    ?>
            </div>
        </div>
    </div>
</div>
