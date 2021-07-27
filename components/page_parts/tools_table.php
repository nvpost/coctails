<?php

?>

<div class="tools_field">
    <h4>
        <?=$table_name;?>
    </h4>

    <table>
        <?php foreach ($tools_arr as $i):?>
            <tr>
                <td class="tool_name">
                    <?=doLink($what, $i[$label])?>
                </td>
                <td class="tool_amount">
                    <?=$i['amount']?>
                </td>
                <td>
                    <?=$i['unit']?>
                </td>

            </tr>
        <?php endforeach;?>
    </table>
</div>