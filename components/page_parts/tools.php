<?php

?>

<div class="tools_field">
    <h4>Посуда и приборы</h4>
    <table>
        <?php foreach ($coctail_tools as $i):?>
            <tr>
                <td class="tool_name">
                    <?=doLink('tools', $i['name'])?>
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
