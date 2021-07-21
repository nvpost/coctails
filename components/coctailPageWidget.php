<?php
$src = array_pop(explode('/', $coctail['src']));
deb($src);
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
        <div class="coctail_page_img">
            <img src="<?=$home_url?>imgs/<?=$src?>" alt="">
        </div>
        <div class="coctail_page_info">
            <?=$coctail_ingredients?>
        </div>
    </div>
</div>
