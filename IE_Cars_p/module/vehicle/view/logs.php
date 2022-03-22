<div id="contenido">
    <table>

        <tr>
            <td width=125><b>Exception</b></th>
            <td width=125><b>Type</b></th>
        </tr>

        <?php
        if ($rdo->num_rows === 0) {
            echo '<tr>';
            echo '<td align="center"  colspan="3">NO HAY Errores.</td>';
            echo '</tr>';
        } else {
            foreach ($rdo as $row) {
                echo '<tr>';
                echo '<td width=125>' . $row['error'] . '</td>';
                echo '<td width=125>' . $row['type'] . '</td>';
                echo '<td width=125>' . $row['created_at'] . '</td>';
                

                echo '</tr>';
            }
        }
        ?>
    </table>

</div>