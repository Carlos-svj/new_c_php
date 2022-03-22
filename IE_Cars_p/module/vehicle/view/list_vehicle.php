<div id="contenido">
    <div class="container">
        <div class="row">
            <h3 data-tr="Car List"><u></u></h3>
        </div>
        <div class="row">
            <div style="display:flex; justify-content:space-between;">
                <div id="crear_vehiculo">
                    <h4 data-tr="Create Car"></h4>
                    <a href="index.php?page=controller_vehicle&op=create"><img src="view/img/mas.png" width="50" height="40"></a>
                </div>
                <div id="crear_lista">
                    <h4 data-tr="Create Car List"></h4>
                    <a href="index.php?page=controller_vehicle&op=dummies"><img src="view/img/mas.png" width="50" height="40"></a>
                </div>
                <div id="eliminar_lista">
                    <h4 data-tr="Delete Car List"></h4>
                    <a href="index.php?page=controller_vehicle&op=delete_all"><img src="view/img/mas.png" width="50" height="40"></a>
                </div>
            </div>

            <p></p>
            <table id="table_home" class="display cell_border compact hover nowrap order-column row-border stripe">
                <thead>
                <tr>
                    <td width=125 data-tr="Id_vehicle"><b></b></th>
                    <td width=125 data-tr="Brand"><b></b></th>
                    <td width=125 data-tr="Model"><b></b></th>
                    <th width=350 data-tr="Operations"><b></b></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($rdo->num_rows === 0) {
                    echo '<tr>';
                    echo '<td align="center"  colspan="3">NO HAY NINGUN vehiculo disp.</td>';
                    echo '</tr>';
                } else {
                    foreach ($rdo as $row) {
                        echo '<tr>';
                        echo '<td width=125>' . $row['id_vehicle'] . '</td>';
                        echo '<td width=125>' . $row['marca'] . '</td>';
                        echo '<td width=125>' . $row['modelo'] . '</td>';
                        echo '<td width=350>';

                        print("<div class='car' id='" . $row['id_vehicle'] . "'>read</div>");  //READ
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                        /*echo '<a class="Button_blue" href="index.php?page=controller_vehicle&op=read&id=' . $row['id_vehicle'] . '">Read</a>';
                        echo '&nbsp;'; */
                        echo '<a class="Button_green" href="index.php?page=controller_vehicle&op=update&id=' . $row['id_vehicle'] . '">Update</a>';
                        echo '&nbsp;';
                        echo '<a class="Button_red" href="index.php?page=controller_vehicle&op=delete&id=' . $row['id_vehicle'] . '">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div id="modalcontent" hidden></div>


<!-- modal window -->
<!-- <section id="id_vehicle_modal">
    <div id="details_vehicle" hidden>
        <div id="details">
            <div id="container">
                id_vehicle: <div id="id_vehicle"></div></br>
                marca: <div id="marca"></div></br>
                modelo: <div id="modelo"></div></br>
                HP: <div id="Hp"></div></br>
                Km: <div id="Km"></div></br>
                Anyo_produccion: <div id="Anyo_produccion"></div></br>
                color: <div id="color"></div></br>
                precio: <div id="precio"></div></br>
            </div>
        </div>
    </div>
</section> -->
