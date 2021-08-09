<?php
?>

<div class="ingredients_field">
    <h4>Ингредиенты</h4>
    <table>
        <?php foreach ($coctail_ingredients as $i):?>
            <tr>
                <td class="tool_name">
                    <?=doLink('ingredient', $i['ingredient'])?>
                </td>
                <td>
                    <?=$i['amount']?>
                </td>
                <td>
                    <?=$i['unit']?>
                </td>

            </tr>
        <?php endforeach;?>
    </table>
</div>
