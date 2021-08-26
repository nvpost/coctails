<?php

?>

<div class="rating_field">
    <div class='own_rating'>
        <?php
        for($i=1; $i<=5; $i++){

            $class = ($i<$coctail_rating)?"active_star":"";
            echo "<i class='{$class} fas fa-star rating_star' data-star={$i}></i>";
        }
        ?>
    </div>
    <div class='publicly_rating'>
    (<?=$coctail_rating?>)
    </div>
</div>
